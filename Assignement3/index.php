<?php
    include 'functions.php';

    $secretMessage = 'CIAO';
    $inputWav = 'media/horse.wav';
    $outputWav = 'media/output_stego.wav';
    $inputGif = 'media/wikipedia_logo.gif';
    $outputGif = 'media/wikipedia_stego.gif';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignement 3 - Esercizio 1</title>
    <link href="css/main.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Assignement 3</a>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Esercizio 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="esercizio2.php">Esercizio 2</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <section class="container">
            <h1 class="mt-5">Assignement 3 - Esercizio 1</h1>
        </section>
        <section class="container">
            <h2>Esercizio proposto n.1 su "Audio/Images/Video Format (JPEG excluded)"</h2>
            <div class="mb-4">
                <h5>Testo dell'esercizio</h5>
                <p>Supponiamo di voler nascondere il messaggio di testo "CIAO" in un file audio WAV. Ogni carattere del messaggio sarà codificato utilizzando il codice ASCII a 8 bit e ogni bit del carattere sarà nascosto nel LSB (Least Significant Bit) di un campione audio. Supponiamo che il file audio abbia una qualità CD.</p>
                <ol>
                    <li>Converti il messaggio di testo in una sequenza binaria.</li>
                    <li>Calcola la dimensione minima del file audio per poter includere il messaggio segreto.</li>
                    <li>Nascondi i bit del messaggio nei LSB dei campioni audio.</li>
                    <li>Scrivi una funzione in PHP che accetta un file audio WAV e un messaggio di testo, e restituisce un nuovo file audio con il messaggio nascosto.</li>
                </ol>
            </div>
            <div class="mb-4">
                <h5>Step 1</h5>
                <p>Rimozione di tutti gli spazi e delle maiuscole</p>
                <code>
                    <?php 
                    $messageProcessed = textPreProcess($secretMessage);
                    echo $messageProcessed;
                    ?>
                </code>
                <p>Conversione in binario di tutte le lettere del messaggio</p>
                <code>
                    <?php
                    $messageBinary = textToBinary($messageProcessed);
                    echo implode(' ', $messageBinary);
                    ?>
                </code>
                <p>Bit totali del messaggio: <?php echo count($messageBinary) * 8 ?></p>
            </div>
            <div class="mb-4">
                <h5>Step 2</h5>
                <p>Calcolo della dimensione minima del file audio:</p>
                <ul>
                    <li>Durata: 10 millisecondi (0,01 secondi)</li>
                    <li>Frequenza di camponamento: 44100 campioni al secondo</li>
                    <li>Canali: 1 (mono)</li>
                    <li>Profondità: 16 bit per campione</li>
                </ul>
                <p>Bit disponibili per inserire il messaggio: <?php echo availableBits(0.01, 44100, 1, 16); ?></p>
            </div>
            <div class="mb-4">
                <h5>Step 3</h5>
                <?php 
                hideMessageInAudio($inputWav, $outputWav, $messageBinary);
                ?>
            </div>
            <div class="mb-4">
                <h5>Step 4</h5>
                <p>Spettrogramma del file audio originale (a sinistra) e del file audio stenografato (a destra):</p>
                <img src="media/horse_spectrogram.png">
                <img src="media/stego_spectrogram.png">
            </div>
        </section>
        <section class="container">
            <h2>Esercizio proposto n.2 su "Audio/Images/Video Format (JPEG excluded)"</h2>
            <div class="mb-4">
                <h5>Testo dell'esercizio</h5>
                <p>L'obiettivo di questo esercizio è nascondere un messaggio di testo all'interno di un'immagine GIF modificando la palette di colori.  Il messaggio segreto "CIAO" sarà nascosto nei bit meno significativi dei colori della palette dell'immagine GIF.</p>
                <ol>
                    <li>Converti il messaggio di testo in una sequenza binaria.</li>
                    <li>Leggere un'immagine GIF di input ed estrai la palette di colori.</li>
                    <li>Identifica quale è il migliore canale in cui nascondere il messaggio.</li>
                    <li>Nascondi i bit del messaggio segreto nei LSB dei colori della palette individuata.</li>
                    <li>Scrivi una funzione in PHP che accetta in input un'immagine GIF e un messaggio di testo, e restituisce una nuova immagine GIF con il messaggio nascosto.</li>
                </ol>
            </div>
            <div class="mb-4">
                <h5>Step 1</h5>
                <p>Rimozione di tutti gli spazi e delle maiuscole</p>
                <code><?php echo $messageProcessed; ?></code>
                <p>Conversione in binario di tutte le lettere del messaggio</p>
                <code><?php echo implode(' ', $messageBinary); ?></code>
            </div>
            <div class="mb-4">
                <h5>Step 2</h5>
                <p>Palette di colori</p>
                <?php drawPaletteTable($inputGif); ?>
            </div>
            <div class="mb-4">
                <h5>Step 3</h5>
                <p></p>
                <?php drawComparisonTable($inputGif); ?>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
</body>
</html>