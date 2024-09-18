<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function script(Request $request, Company $company)
    {
        $this->generateSprites();
        // Array of file names (not full paths)
        $files = [
            'helper.js',
            'global.js',
            'assets.js',
            'loading.js',
            'activity.js',
            'main.js',
        ];

        $plugins = [
            'moment.min.js',
            'moment-timezone-with-data-10-year-range.min.js',
            'jquery.min.js',
        ];

        $pluginScripts = $this->getFiles($plugins, 'plugins');
        $mainScript = $this->getFiles($files, 'ghl');
        $files = "
            $pluginScripts
            (function () {
                $mainScript
            })();
        ";

        return response($files, 200)
            ->header('Content-Type', 'application/javascript');
    }

    public function getFiles ($fileNames, $folder)
    {
        // Determine the base path based on the environment
        $basePath = app()->environment('local') ?
            resource_path("js/$folder") :
            public_path("js/$folder");

        // Initialize an empty string to hold the concatenated content
        $files = '';

        // Loop through each file name
        foreach ($fileNames as $fileName) {
            // Construct the full path based on the base path and file name
            $path = $basePath . '/' . $fileName;

            // Check if the file exists
            if (File::exists($path)) {
                // Get the contents of the file and append it to the concatenated content
                $files .= File::get($path) . "\n"; // "\n" adds a newline between file contents
            } else {
                // Handle the case where the file is not found
                $files .= "/* Error: File at $path not found */\n";
            }
        }

        return $files;
    }

    /**
     * Generates the sprites.js file.
     * This file contains the SVG icons as JavaScript objects.
     * Collecting all the SVG icons in a single file makes it easier to manage and update the icons.
     * The sprites.js file is generated in the public/js directory.
     * @return void
     */
    public function generateSprites ()
    {
        $svgDirectory = resource_path('svg');
        // $outputPath = resource_path('js/sprites.js');
        $filePath = 'js/sprites.js';
        $svgFiles = File::files($svgDirectory);

        $spriteContent = 'const konzkriptSprites = `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="konzkript--sprites" style="display: none;">' . PHP_EOL;

        foreach ($svgFiles as $file) {
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $svgContent = File::get($file);

            // Extract and remove class attributes
            $svgContent = preg_replace('/class="[^"]*"/', '', $svgContent);

            // Extract attributes
            preg_match('/<svg([^>]*)>/', $svgContent, $svgAttributes);
            $attributes = isset($svgAttributes[1]) ? $svgAttributes[1] : '';

            // Remove the SVG tag since it will be wrapped in a symbol
            $svgContent = preg_replace('/<svg[^>]*>/', '', $svgContent);
            $svgContent = str_replace('</svg>', '', $svgContent);

            $spriteContent .= "    <symbol id=\"{$fileName}\" {$attributes}>\n";
            $spriteContent .= $this->indentSvgContent(trim($svgContent), 2)."\n";
            $spriteContent .= "    </symbol>\n";
        }

        $spriteContent .= '</svg>`' . PHP_EOL;

        Storage::disk('public')->put($filePath, $spriteContent);


        // File::put($outputPath, $spriteContent);
    }

    /**
     * Helper function to add indentation to SVG content.
     *
     * @param string $svgContent
     * @param int $indentLevel
     * @return string
     */
    private function indentSvgContent($svgContent, $indentLevel)
    {
        $indentation = str_repeat('    ', $indentLevel);
        return preg_replace('/^/m', $indentation, $svgContent);
    }
}
