<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    |
    | {route}/{template}/{filename}

    {{ route('imagecache', [ 'template'=>'sbixs','filename' => $post->fiName() ]) }}
    |
    | Examples: "images", "img/cache"
    |
    */
    #  http://image.intervention.io/use/url

    'route'=>'uslive',
    // 'route' => null,

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submitted
    | by URI.
    |
    | Define as many directories as you like.
    |
    */

     'paths' => array(
        public_path(),  //sample path from interv...
        // public_path('upload'),  //sample path from interv...
        // public_path('images'),  //sample path from interv...
        public_path('img'), //some images for aamaar
        public_path('storage/user/pp'), # user identity image
        // public_path('storage/media'), # user identity image
        // public_path('storage/media/image'), # user identity image
        public_path('storage/cat/image'),
        public_path('storage/cat/banner'),
        public_path('storage/subcat/image'),
        public_path('storage/lead/fi'), # user identity image
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */

    'templates' => array(

        'small' => 'Intervention\Image\Templates\Small',
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',
        'ppxxs' => 'App\ImageFilters\ProfilePicXXS',
        'fifh' => 'App\ImageFilters\FeatureImageForHome',
        'ppxs' => 'App\ImageFilters\ProfilePicXS',
        'ppsm' => 'App\ImageFilters\ProfilePicSmall',
        'ppsmbl' => 'App\ImageFilters\ProductPicSmallBlur',
        'ppmd' => 'App\ImageFilters\ProfilePicMedium',
        'pplg' => 'App\ImageFilters\ProfilePicLarge',
        'ppxlg' => 'App\ImageFilters\ProfilePicXLarge',
        'cpxs' => 'App\ImageFilters\CoverPicXS',
        'cpxxxs' => 'App\ImageFilters\CoverPicXXXS',
        'cpsm' => 'App\ImageFilters\CoverPicSmall',
        'cpmd' => 'App\ImageFilters\CoverPicMedium',
        'cplg' => 'App\ImageFilters\CoverPicLarge',
        'cpxlg' => 'App\ImageFilters\CoverPicXLarge',
        'cpxxlg' => 'App\ImageFilters\CoverPicXXLarge',
        'slmd' => 'App\ImageFilters\LogoMedium',
        'pfilg' => 'App\ImageFilters\ProductPicLarge',
        'pfimd' => 'App\ImageFilters\ProductPicMedium',
        'pfism' => 'App\ImageFilters\ProductPicSmall',
        'pnism' => 'App\ImageFilters\ProductNormalPicSmall',
        'pnimd' => 'App\ImageFilters\ProductNormalPicMedium',
        'pnilg' => 'App\ImageFilters\ProductNormalPicLarge',
        'sbism' => 'App\ImageFilters\SidebarImageSmall',
        'sbixs' => 'App\ImageFilters\SidebarImageXtraSmall',
        'lh' => 'App\ImageFilters\LogoHeader',
    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */

    'lifetime' => 43200,

);
