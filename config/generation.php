<?php

use Codeat3\BladeIconGeneration\Exceptions\InvalidFileExtensionException;
use Codeat3\BladeIconGeneration\IconProcessor;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

$svgNormalization = static function (string $tempFilepath, array $iconSet, SplFileInfo $sourceFile) {

    if($sourceFile->getFilename() !== '24px.svg') {
        unlink($tempFilepath);
        return;
    }
    // perform generic optimizations
    try {
        $iconProcessor = new IconProcessor($tempFilepath, $iconSet, $sourceFile);
        $iconProcessor
            ->optimize()
            ->save(function ($name, $file) use ($sourceFile, $iconSet)  {
                $relativePath = Str::replace(__DIR__.'/../', '', $sourceFile->getPath());
                $explodePath = explode('/', $relativePath);
                if(count($explodePath)=== 5) {
                    $suffix = $iconSet['output-suffix'] ?? '';
                    return $explodePath[3].$suffix;
                }
            });
    }catch (InvalidFileExtensionException $e) {
        print_r($e->getMessage());
        unlink($tempFilepath);
        return;
    }

};

return [
    [
        'source' => __DIR__.'/../dist/src/*/*/materialicons/',
        'destination' => __DIR__.'/../resources/svg',
        'safe' => true,
        'after' => $svgNormalization,
        'is-solid' => true,
    ],
    [
        'source' => __DIR__.'/../dist/src/*/*/materialiconsround/',
        'destination' => __DIR__.'/../resources/svg',
        'safe' => true,
        'after' => $svgNormalization,
        'is-solid' => true,
        'output-suffix' => '-r',
    ],
    [
        'source' => __DIR__.'/../dist/src/*/*/materialiconssharp/',
        'destination' => __DIR__.'/../resources/svg',
        'safe' => true,
        'after' => $svgNormalization,
        'is-solid' => true,
        'output-suffix' => '-s',
    ],
    [
        'source' => __DIR__.'/../dist/src/*/*/materialiconstwotone/',
        'destination' => __DIR__.'/../resources/svg',
        'safe' => true,
        'after' => $svgNormalization,
        'is-solid' => true,
        'output-suffix' => '-tt',
    ],
    [
        'source' => __DIR__.'/../dist/src/*/*/materialiconsoutlined/',
        'destination' => __DIR__.'/../resources/svg',
        'safe' => true,
        'after' => $svgNormalization,
        'is-solid' => true,
        'output-suffix' => '-o',
    ],
];
