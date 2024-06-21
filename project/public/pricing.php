<?php
require __DIR__ . '/../src/bootstrap.php';
?>

<?php view('header', ['page' => $PAGES['pricing']]) ?>

<section class="container py-3"> 
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Prezzi</h1>
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

<?php view('footer') ?>