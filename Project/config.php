<?php
$hmacKey = 30911337928580013;

$db = array(
    'server' => 'localhost',
    'user' => 'frontend',
    'password' => '75)E/QCwdHIGF!8-',
    'name' => 'video_corsi'
);

$alertAddress = 'zof.emanuele@spes.uniud.it';

$pages = array(
    'index' => array(
        'restricted' => false,
        'title' => 'Home page - Piattaforma di video corsi'
    ),
    'courses' => array(
        'restricted' => true,
        'title' => 'Tutti corsi disponibili - Piattaforma di video corsi'
    ),
    'course' => array(
        'restricted' => true,
        'title' => 'Corso - Piattaforma di video corsi'
    ),
    'info' => array(
        'restricted' => false,
        'title' => 'Informazioni - Piattaforma di video corsi'
    ),
    'pricing' => array(
        'restricted' => false,
        'title' => 'Prezzi - Piattaforma di video corsi'
    ),
    'signin' => array(
        'restricted' => false,
        'title' => 'Sign in - Piattaforma di video corsi'
    ),
    'register' => array(
        'restricted' => false,
        'title' => 'Registration - Piattaforma di video corsi'
    ),
);
?>