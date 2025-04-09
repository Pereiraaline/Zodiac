<?php include('layouts/header.php'); ?>

<h1 class="mb-4">Descubra seu Signo</h1>
<p class="lead text-light mb-4">Informe sua data de nascimento e mergulhe nos mistérios do zodíaco.</p>

<form action="show_zodiac_sign.php" method="POST">
    <div class="form-group mb-3">
        <input type="date" name="data_nascimento" class="form-control form-control-lg" required>
    </div>
    <button type="submit" class="btn btn-outline-warning btn-lg">Descobrir Signo</button>
</form>
</div> <!-- fecha .container -->
</body>
<?php include('layouts/footer.php'); ?>
</html>
