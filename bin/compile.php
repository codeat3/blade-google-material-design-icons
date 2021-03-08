<?php

require_once "vendor/autoload.php";

use Symfony\Component\Finder\Finder;
use Symfony\Component\DomCrawler\Crawler;

class SvgIconCleaner
{
    const RESOURCE_DIR = "resources/svg";

    protected $attrsNotRequired = [
        "id",
        "class",
        "width",
        "height",
    ];

    protected $replacePatterns = [
        '/\s(id=\"[a-b0-9]{2}\")/' => '',
        '/\s(class=\"[a-b0-9]{2}\")/' => '',
        '/\s(height=\"[0-9]+\")/' => '',
        '/\s(width=\"[0-9]+\")/' => '',
    ];

    private function removeAttributes()
    {
        $finder = new Finder();
        $finder->files()->in(self::RESOURCE_DIR);
        foreach ($finder as $file) {
            $text = $file->getContents();
            $newtext = preg_replace(array_keys($this->replacePatterns), array_values($this->replacePatterns), $text);
            if ($text !== $newtext) {
                file_put_contents($file->getRealPath(), $newtext);
            }
        }
    }

    private function replaceSolidPatterns($svgText)
    {

        // check if exists
        preg_match('/<svg.*(fill\=\"currentColor\".*?>)/', $svgText, $matches);

        if (count($matches) == 2 && isset($matches[0])) {
            return false;
        }

        // replace it

        preg_match('/<svg.*?>/', $svgText, $matches);

        if (count($matches) > 0 && isset($matches[0])) {
            $source = $matches[0];
            $replacement = str_replace('>', ' fill="currentColor">', $source);
            $svgText = str_replace($source, $replacement, $svgText);
        }
        return $svgText;
    }

    //fill="none" stroke="currentColor"
    private function replaceOutlinePatterns($svgText)
    {

        // check if exists
        preg_match('/<svg.*(fill\=\"none\"\sstroke\=\"currentColor\".*?>)/', $svgText, $matches);

        if (count($matches) == 2 && isset($matches[0])) {
            return false;
        }

        // replace it

        preg_match('/<svg.*?>/', $svgText, $matches);

        if (count($matches) > 0 && isset($matches[0])) {
            $source = $matches[0];
            $replacement = str_replace('>', ' fill="none" stroke="currentColor">', $source);
            $svgText = str_replace($source, $replacement, $svgText);
        }
        return $svgText;
    }

    private function addAttributes()
    {
        // for solid icons
        $finder = new Finder();
        $finder->files()->in(self::RESOURCE_DIR)->name('/\-(r|s|tt)\.svg$/');
        foreach ($finder as $file) {
            $changedText = $this->replaceSolidPatterns($file->getContents());
            if ($changedText !== false) {
                file_put_contents($file->getRealPath(), $changedText);
            } else {
                echo 'no changes'.PHP_EOL;
            }
        }

        // for outline icons
        $finder = new Finder();
        $finder->files()->in(self::RESOURCE_DIR)->name('*-o.svg');
        foreach ($finder as $file) {
            $changedText = $this->replaceOutlinePatterns($file->getContents());
            if ($changedText !== false) {
                file_put_contents($file->getRealPath(), $changedText);
            }
        }
    }

    public function process()
    {
        $this->removeAttributes();

        $this->addAttributes();
    }
}
$svgCleaner = new SvgIconCleaner();
$svgCleaner->process();
