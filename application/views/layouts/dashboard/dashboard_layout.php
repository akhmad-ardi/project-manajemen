<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="generator" content="Hugo 0.122.0">
  <title><?= $page_info['title'] ?> | [Kelola]</title>
  <meta name="theme-color" content="#712cf9">

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?= base_url() ?>assets/css/template-style.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
</head>

<body>
  <?php $this->load->view("components/dashboard/dashboard_header") ?>

  <div class="container-fluid">
    <div class="row">
      <?php $this->load->view("components/dashboard/dashboard_sidebar") ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <section id="#projects" class="container px-4 py-3">
          <?php $this->load->view('components/dashboard/dashboard_breadcrumb') ?>
          <?php $this->load->view("pages/dashboard/" . $page_info["page"]) ?>
        </section>
      </main>
    </div>
  </div>

  <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
</body>

</html>

</body>

</html>