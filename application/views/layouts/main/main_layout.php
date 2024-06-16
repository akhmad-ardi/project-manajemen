<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <!-- Bootstrap Icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!--google font  -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
    rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/template-style.css">
  <title>[Kelola]</title>
</head>

<body>

  <?php $this->load->view("components/main/main_navbar") ?>
  <?php $this->load->view("pages/main/main_page") ?>
  <?php $this->load->view("components/main/main_footer") ?>

  <!-- Bootstrap core JS-->
  <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
  <!-- Core theme JS-->
  <script src="<?= base_url() ?>assets/js/template-script.js"></script>
</body>

</html>