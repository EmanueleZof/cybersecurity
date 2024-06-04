<!DOCTYPE html>
<html lang="it">
<head>
    <title>Home page - Piattaforma video corsi</title>
    <?php include 'widgets/head.php'; ?>
</head>
<body>
    <?php include 'widgets/navigation.php'; ?>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check" viewBox="0 0 16 16">
            <title>Check</title>
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
        </symbol>
    </svg>
    <!-- TODO: da vedere se ha senso -->
    <main>
        <section class="container py-3"> 
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal text-body-emphasis">Prezzi</h1>
                <p class="fs-5 text-body-secondary">L'accesso alla piattaforma è riservato agli utenti registrati</p>
            </div>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th style="width: 34%;"></th>
                        <th style="width: 22%;">Free</th>
                        <th style="width: 22%;">Pro</th>
                        <th style="width: 22%;">Enterprise</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row" class="text-start">Public</th>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Private</th>
                        <td></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                    </tr>
                    </tbody>

                    <tbody>
                    <tr>
                        <th scope="row" class="text-start">Permissions</th>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Sharing</th>
                        <td></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Unlimited members</th>
                        <td></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Extra security</th>
                        <td></td>
                        <td></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <?php include 'widgets/footer.php'; ?>
</body>
</html>