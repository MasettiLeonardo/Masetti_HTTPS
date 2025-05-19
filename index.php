<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relazione del progetto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg my-10">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Relazione del progetto</h1>

    <p class="mb-4 text-lg">Questa relazione descrive il processo di realizzazione del nostro sito web, le tecnologie
        adottate e la configurazione dell’ambiente Docker per garantire sicurezza, modularità e facilità di
        gestione.</p>

    <h2 class="text-2xl font-semibold text-blue-500 mt-6 mb-3">1. Architettura del Progetto</h2>
    <p class="mb-4">Abbiamo creato una Single Page Application ospitata su una infrastruttura basata su container
        Docker. L’accesso al sito è protetto da HTTPS (con certificato self-signed) e prevede una pagina di login sicura
        che consente l'accesso solo se le credenziali inserite sono corrette.</p>

    <h2 class="text-2xl font-semibold text-blue-500 mt-6 mb-3">2. Container Utilizzati</h2>
    <ul class="list-disc ml-6 mb-4">
        <li><strong>Web Server (Nginx):</strong> Si occupa di servire il sito staticamente e di inoltrare le richieste
            PHP. È configurato per gestire la crittografia HTTPS tramite certificato SSL self-signed e reindirizzare
            tutto il traffico HTTP verso HTTPS.
        </li>
        <li><strong>PHP (fpm):</strong> Questo container gestisce l’esecuzione del codice PHP, incluso il sistema di
            login e l’interazione con il database.
        </li>
        <li><strong>Database (MariaDB):</strong> Conserva in modo sicuro le credenziali degli utenti registrati,
            gestisce autenticazioni e operazioni CRUD tramite interfaccia PHP.
        </li>
    </ul>

    <h2 class="text-2xl font-semibold text-blue-500 mt-6 mb-3">3. Implementazione del Sito Web</h2>
    <p class="mb-4">L'interfaccia utente è sviluppata in HTML5 e CSS3, rispettando gli standard moderni. Il form di
        login rappresenta l’ingresso principale al sito e protegge i contenuti tramite autenticazione sicura. Bootstrap
        e Tailwind CSS sono stati utilizzati per facilitare la progettazione responsive e moderna.</p>

    <h2 class="text-2xl font-semibold text-blue-500 mt-6 mb-3">4. HTTPS e Sicurezza</h2>
    <ul class="list-disc ml-6 mb-4">
        <li>Abbiamo generato un certificato SSL auto-firmato per criptare le comunicazioni client-server.</li>
        <li>Tutte le connessioni HTTP vengono automaticamente reindirizzate a HTTPS grazie alla configurazione Nginx.
        </li>
        <li>Il traffico non criptato è completamente bloccato, garantendo che tutte le informazioni scambiate siano
            protette.
        </li>
    </ul>

    <h2 class="text-2xl font-semibold text-blue-500 mt-6 mb-3">5. Tecnologie e Strumenti Utilizzati</h2>
    <ul class="list-disc ml-6 mb-4">
        <li><strong>Docker e Docker Compose:</strong> Per orchestrare l’ambiente composto da più container (web server,
            PHP, database).
        </li>
        <li><strong>Nginx:</strong> Come server web veloce, configurato per HTTPS.</li>
        <li><strong>PHP:</strong> Per la logica lato server, login e accesso al database.</li>
        <li><strong>MariaDB:</strong> Per la gestione dei dati degli utenti.</li>
        <li><strong>HTML5/CSS3 + Tailwind:</strong> Per l’interfaccia utente moderna e responsive.</li>
        <li><strong>OpenSSL:</strong> Utilizzato per creare il certificato SSL self-signed.</li>
    </ul>

    <h2 class="text-2xl font-semibold text-blue-500 mt-6 mb-3">6. Conclusioni</h2>
    <p class="mb-4">Questo progetto ha permesso di realizzare una web app sicura, modulare e facilmente distribuibile
        grazie a Docker. Abbiamo separato logicamente ogni componente dell’infrastruttura, rendendo il sistema più
        stabile, manutenibile e riutilizzabile.</p>
    <p class="mb-4">L’uso di HTTPS con certificato auto-firmato, sebbene pensato per ambienti di sviluppo o testing,
        garantisce un livello minimo di sicurezza, rendendo chiaro il concetto di cifratura e trasporto sicuro delle
        informazioni.</p>
</div>

</body>
</html>
