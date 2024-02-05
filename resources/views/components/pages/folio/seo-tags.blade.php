@props(['page'])
@use('Artesaos\SEOTools\Facades\SEOTools')
@php
    $title =  __("content.$page.title");
    $description= __("content.$page.description");

    SEOTools::setTitle($title);
    SEOTools::setDescription($description);
@endphp