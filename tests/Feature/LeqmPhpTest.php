<?php

use Pforret\LeqmPhp\Exceptions\MeasurementException;
use Pforret\LeqmPhp\LeqmPhp;
use Pforret\LeqmPhp\LeqmResult;

beforeAll(function () {
    // Ensure binaries are downloaded
    $binDir = dirname(__DIR__, 2).'/bin';
    $binaries = ['goqm_linux', 'goqm_macos', 'goqm_macos_arm', 'goqm_win.exe'];
    $hasBinary = false;

    foreach ($binaries as $binary) {
        if (file_exists($binDir.'/'.$binary)) {
            $hasBinary = true;
            break;
        }
    }

    if (! $hasBinary) {
        throw new RuntimeException(
            'No goqm binaries found. Run bin/download-goqm.sh first.'
        );
    }
});

describe('LeqmPhp', function () {

    it('can measure test1.wav', function () {
        $leqm = new LeqmPhp;
        $result = $leqm->measure(dirname(__DIR__, 2).'/media/test1.wav');

        expect($result)->toBeInstanceOf(LeqmResult::class);
        expect($result->getLeqM())->toBeFloat();
        expect($result->getLeqM())->toBeGreaterThan(0);
        expect($result->getChannels())->toBeGreaterThan(0);
        expect($result->getDuration())->toBeGreaterThan(0);
    });

    it('can measure test2.wav', function () {
        $leqm = new LeqmPhp;
        $result = $leqm->measure(dirname(__DIR__, 2).'/media/test2.wav');

        expect($result)->toBeInstanceOf(LeqmResult::class);
        expect($result->getLeqM())->toBeFloat();
        expect($result->getLeqM())->toBeGreaterThan(0);
        expect($result->getSampleRate())->toBeGreaterThan(0);
    });

    it('can measure test3.wav', function () {
        $leqm = new LeqmPhp;
        $result = $leqm->measure(dirname(__DIR__, 2).'/media/test3.wav');

        expect($result)->toBeInstanceOf(LeqmResult::class);
        expect($result->getLeqM())->toBeFloat();
        expect($result->getLeqNoWeight())->toBeFloat();
        expect($result->getMeanPower())->toBeFloat();
    });

    it('can measure test4.wav', function () {
        $leqm = new LeqmPhp;
        $result = $leqm->measure(dirname(__DIR__, 2).'/media/test4.wav');

        expect($result)->toBeInstanceOf(LeqmResult::class);
        expect($result->getLeqM())->toBeFloat();
        expect($result->getExecutionTime())->toBeGreaterThan(0);
    });

    it('returns channel stats for stereo files', function () {
        $leqm = new LeqmPhp;
        $result = $leqm->measure(dirname(__DIR__, 2).'/media/test1.wav');

        $channelStats = $result->getChannelStats();
        expect($channelStats)->toBeArray();

        if ($result->getChannels() >= 2) {
            expect($result->getChannelPeakDb(0))->toBeFloat();
            expect($result->getChannelPeakDb(1))->toBeFloat();
            expect($result->getChannelAverageDb(0))->toBeFloat();
            expect($result->getChannelAverageDb(1))->toBeFloat();
        }
    });

    it('can convert result to array', function () {
        $leqm = new LeqmPhp;
        $result = $leqm->measure(dirname(__DIR__, 2).'/media/test1.wav');

        $array = $result->toArray();
        expect($array)->toBeArray();
        expect($array)->toHaveKey('metadata');
        expect($array)->toHaveKey('measurements');
        expect($array)->toHaveKey('channel_stats');
        expect($array)->toHaveKey('execution');
    });

    it('can convert result to JSON', function () {
        $leqm = new LeqmPhp;
        $result = $leqm->measure(dirname(__DIR__, 2).'/media/test1.wav');

        $json = $result->toJson();
        expect($json)->toBeString();

        $decoded = json_decode($json, true);
        expect($decoded)->toBeArray();
    });

    it('throws exception for non-existent file', function () {
        $leqm = new LeqmPhp;
        $leqm->measure('/non/existent/file.wav');
    })->throws(MeasurementException::class, 'Audio file not found');

    it('returns correct file path in result', function () {
        $leqm = new LeqmPhp;
        $filePath = dirname(__DIR__, 2).'/media/test1.wav';
        $result = $leqm->measure($filePath);

        expect($result->getFile())->toContain('test1.wav');
    });

    it('measures different files with different results', function () {
        $leqm = new LeqmPhp;

        $result1 = $leqm->measure(dirname(__DIR__, 2).'/media/test1.wav');
        $result3 = $leqm->measure(dirname(__DIR__, 2).'/media/test3.wav');

        // Files should have different characteristics (test1 and test3 have different durations)
        expect($result1->getFrames())->not->toBe($result3->getFrames());
    });

});
