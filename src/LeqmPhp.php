<?php

namespace Pforret\LeqmPhp;

use Pforret\LeqmPhp\Exceptions\BinaryNotFoundException;
use Pforret\LeqmPhp\Exceptions\MeasurementException;

class LeqmPhp
{
    private string $binaryPath;

    public function __construct(?string $binaryPath = null)
    {
        $this->binaryPath = $binaryPath ?? $this->detectBinary();
    }

    public function measure(string $audioFile): LeqmResult
    {
        if (! file_exists($audioFile)) {
            throw new MeasurementException("Audio file not found: $audioFile");
        }

        $command = escapeshellarg($this->binaryPath).' '.escapeshellarg($audioFile);

        $output = [];
        $returnCode = 0;
        exec($command.' 2>&1', $output, $returnCode);

        if ($returnCode !== 0) {
            throw new MeasurementException(
                "Binary execution failed with code $returnCode: ".implode("\n", $output)
            );
        }

        $jsonOutput = implode("\n", $output);
        $data = json_decode($jsonOutput, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new MeasurementException(
                'Failed to parse JSON output: '.json_last_error_msg()."\nOutput: $jsonOutput"
            );
        }

        return new LeqmResult($data);
    }

    public function getBinaryPath(): string
    {
        return $this->binaryPath;
    }

    private function detectBinary(): string
    {
        $binDir = dirname(__DIR__).'/bin';
        $binary = match (PHP_OS_FAMILY) {
            'Darwin' => php_uname('m') === 'arm64' ? 'goqm_macos_arm' : 'goqm_macos',
            'Linux' => 'goqm_linux',
            'Windows' => 'goqm_win.exe',
            default => throw new BinaryNotFoundException('Unsupported OS: '.PHP_OS_FAMILY),
        };

        $path = $binDir.'/'.$binary;

        if (! file_exists($path)) {
            throw new BinaryNotFoundException(
                "Binary not found: $path. Run bin/download-goqm.sh to download binaries."
            );
        }

        if (! is_executable($path) && PHP_OS_FAMILY !== 'Windows') {
            throw new BinaryNotFoundException("Binary is not executable: $path");
        }

        return $path;
    }
}
