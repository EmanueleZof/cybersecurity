<?php
const APP_URL = 'http://localhost:8888/project/public'; //TODO
const ADMIN_EMAIL = '';

$PAGES = array(
    'index' => array(
        'name' => 'index',
        'restricted' => false,
        'title' => 'Home page - Piattaforma di video corsi'
    ),
    'courses' => array(
        'name' => 'courses',
        'restricted' => true,
        'title' => 'Tutti corsi disponibili - Piattaforma di video corsi'
    ),
    'course' => array(
        'name' => 'course',
        'restricted' => true,
        'title' => 'Corso - Piattaforma di video corsi'
    ),
    'info' => array(
        'name' => 'info',
        'restricted' => false,
        'title' => 'Informazioni - Piattaforma di video corsi'
    ),
    'pricing' => array(
        'name' => 'pricing',
        'restricted' => false,
        'title' => 'Prezzi - Piattaforma di video corsi'
    ),
    'signin' => array(
        'name' => 'signin',
        'restricted' => false,
        'title' => 'Sign in - Piattaforma di video corsi'
    ),
    'register' => array(
        'name' => 'register',
        'restricted' => false,
        'title' => 'Registration - Piattaforma di video corsi'
    ),
);
?>