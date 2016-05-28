<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir = __DIR__.'/core/Models')
    ->in($dir = __DIR__.'/core/Services');

// generate documentation for all v2.0.* tags, the 2.0 branch, and the master one
//$versions = GitVersionCollection::create($dir)
//    ->addFromTags('v2.0.*')
//    ->add('2.0', '2.0 branch')
//    ->add('master', 'master branch')
//;

return new Sami($iterator, array(
//    'theme'                => 'symfony',
//    'versions'             => $versions,
    'title'                => 'Eeevee References',
    'build_dir'            => '../reference.eevee.io/web/%version%',
    'cache_dir'            => '../reference.eevee.io/cache/%version%',
    'remote_repository'    => new GitHubRemoteRepository('fourever/eevee', dirname($dir)),
    'default_opened_level' => 2,
));