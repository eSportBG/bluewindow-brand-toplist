<?php
    $this->title = 'Brand Toplist';
    \frontend\assets\AppAsset::register($this);
?>

<header><h1><?= $this->title ?></h1></header>

<section id="create-form" class="container my-5">
  <h2 class="mb-4">Add a Brand</h2>
  <form id="brand-form" class="row g-3">
    <div class="col-md-3">
      <label for="brand-name" class="form-label">Name</label>
      <input id="brand-name" name="name" type="text" class="form-control" placeholder="Brand name" required>
    </div>
    <div class="col-md-3">
      <label for="brand-image" class="form-label">Image URL</label>
      <input id="brand-image" name="image" type="url" class="form-control" placeholder="https://… || http://… " required>
    </div>
    <div class="col-md-2">
      <label for="brand-rating" class="form-label">Rating</label>
      <input id="brand-rating" name="rating" type="number" min="0" max="5" class="form-control" placeholder="0–5" required>
    </div>
    <div class="col-md-2">
      <label for="brand-country" class="form-label">Country Code</label>
      <input id="brand-country" name="country_code" type="text" maxlength="2" class="form-control text-uppercase" placeholder="BG" required>
    </div>
    <div class="col-md-2 d-flex align-items-end">
      <button type="submit" class="btn btn-success w-100">Create</button>
    </div>
    <div class="col-12">
      <p id="form-message" class="mt-2 mb-0"></p>
    </div>
  </form>

<!-- Alert placeholder -->
<div id="form-alert"></div>

</section>

<main>
  <div class="brand-table">
    <div class="brand-table__header">
      <div class="col-rank">#</div>
      <div class="col-logo">Brand image / Brand name</div>
      <div class="col-rating">Brand Rating</div>
      <div class="col-bonus">Country Code</div>
      <div class="col-actions">Actions</div>
    </div>
    <div id="brand-list"><!-- rows go here --></div>
  </div>
</main>