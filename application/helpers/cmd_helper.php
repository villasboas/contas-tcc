<?php
/**
 * remove_comments
 *
 * remove os comentários de uma string
 *
 * @return void
 */
if ( !function_exists( 'remove_comments' ) ) {
    function remove_comments() {
        
        //  Removes multi-line comments and does not create
        //  a blank line, also treats white spaces/tabs
        $text = preg_replace('!^[ \t]*/\*.*?\*/[ \t]*[\r\n]!s', '', $text);

        //  Removes single line '//' comments, treats blank characters
        $text = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', '', $text);

        //  Strip blank lines
        $text = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $text);
    }
}
        
/**
 * file_force_contents
 *
 * força a criação de um arquivocd
 *
 * @param [type] $dir
 * @param [type] $contents
 * @return void
 */
if ( !function_exists( 'file_force_contents' ) ) {
    function file_force_contents($dir, $contents) {
        
        // separa as partes do caminho
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        
        // percorre as mesmas
        foreach ($parts as $part) {
            $dir = trim( $dir, '/' );
            if (!is_dir( $dir .= "/$part" )) {
                mkdir( $dir );
            }
        }
            
        // cria o arquivo
        file_put_contents("$dir/$file", $contents);
    }
}

/**
 * cmdLine
 * 
 * Imprime uma linha no CMD
 * 
 */
if ( !function_exists( 'cmdLine' ) ) {
    function cmdLine( $line ) {
        print '[PHPMAKER] '.$line.PHP_EOL;
    }
}

/**
 * deploy_path
 * 
 * Volta o caminho da pasta de deploy
 * 
 */
if ( !function_exists( 'deploy_path' ) ) {
    function deploy_path( $path = '' ) {

        // Pega a instancia do ci
        $ci =& get_instance();

        // Carega as configurações do FTP
        $ci->config->load( 'ftp' );
        $ftp = $ci->config->item( 'ftp' );

        // Seta o caminho completo
        return $ftp['site_dir'].$path;
    }
}

/**
 * Copy a file, or recursively copy a folder and its contents
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.0.1
 * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
 * @param       string   $source    Source path
 * @param       string   $dest      Destination path
 * @param       int      $permissions New folder creation permissions
 * @return      bool     Returns true on success, false on failure
 */

if ( ! function_exists( 'xcopy' ) ) {
    function xcopy( $source, $dest, $permissions = 0755 ) {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }
    
        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }
    
        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }
    
        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }
    
            // Deep copy directories
            xcopy("$source/$entry", "$dest/$entry", $permissions);
        }
    
        // Clean up
        $dir->close();
        return true;
    }
}

/**
 * xremove
 * 
 * Remove um diretório
 * 
 */
if ( ! function_exists( 'xremove' ) ) {
    function xremove($dir) { 
        if ( is_dir( $dir ) ) { 
            $objects = scandir( $dir ); 
            foreach ( $objects as $object ) { 
            if ( $object != "." && $object != ".." ) { 
                if ( is_dir( $dir."/".$object ) ) {
                xremove( $dir."/".$object );
                } else {
                unlink( $dir."/".$object );
                } 
            } 
            }
            rmdir($dir); 
        } 
    }
}

// End of file