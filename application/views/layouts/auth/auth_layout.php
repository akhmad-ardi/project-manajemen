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
  <!-- Bootstrap core JS-->
  <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
  <!-- Core theme JS-->
  <script src="<?= base_url() ?>assets/js/template-script.js"></script>
  <script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.js"></script>
  <script src="<?= base_url() ?>assets/js/auth.js"></script>
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/template-style.css">
  <title>
    <?= isset($page_info['title']) && $page_info['title'] ? $page_info['title'] . " | " : "" ?>
    [Kelola]
  </title>
</head>

<body>

  <?php $this->load->view("components/auth/auth_navbar") ?>
  <?php $this->load->view($page_info['page']) ?>

  <script src="<?= base_url() ?>assets/js/auth.js"></script>
</body>

</html>