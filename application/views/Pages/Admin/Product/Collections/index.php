<main id="main" class="main">
  <div class="pagetitle">
    <h1>Products</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item active"><a href="<?= base_url('/index.php/Product/collections')?>">Collections & Categories</a></li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-12">
            <div class="card top-selling overflow-auto">
              <div class="card-body">
                <h5 class="card-title">Collections & Categories <span>| Produk</span></h5>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addcollections">
                  <i class="bi bi-plus-circle-fill"></i> Add Collection
                </button>

                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Create At</th>
                      <th scope="col">Name Collections</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($collections as $collect): ?>
                    <tr>
                      <th scope="row"><a href="#"><?= $collect->id ?></a></th>
                      <td><?= $collect->created_at ?></td>
                      <td><a href="#" class="text-info"><?= $collect->nama_koleksi ?></a></td>
                      <td>
                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#showcategories<?= $collect->id ?>">
                          <i class="bi bi-tags-fill"></i> Manage Categories
                        </button>
                        <!-- Show Categories Modal -->
                          <div class="modal fade" id="showcategories<?= $collect->id ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Manage Categories: <?= $collect->nama_koleksi ?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                  <!-- Input kategori baru -->
                                  <form action="<?= base_url('index.php/Product/create_category') ?>" method="post">
                                    <input type="hidden" name="collection_id" value="<?= $collect->id ?>">
                                    <div class="input-group mb-3">
                                      <input type="text" class="form-control" name="nama_kategori" placeholder="Nama kategori baru">
                                      <button class="btn btn-success" type="submit">Tambah</button>
                                    </div>
                                  </form>


                                  <!-- Tabel kategori yang sudah ada -->
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($categories[$collect->id])): ?>
                                      <?php foreach ($categories[$collect->id] as $kategori): ?>
                                        <tr>
                                          <td><?= $kategori->nama_kategori ?></td>
                                          <td>
                                            <!-- Update -->
                                            <form class="d-inline" method="post" action="<?= base_url('index.php/Product/update_category') ?>">
                                              <input type="hidden" name="id" value="<?= $kategori->id ?>">
                                              <input type="text" name="nama_kategori" value="<?= $kategori->nama_kategori ?>" class="form-control d-inline w-50">
                                              <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                            </form>
        
                                            <!-- Delete -->
                                            <form class="d-inline" method="post" action="<?= base_url('index.php/Product/delete_category') ?>" onsubmit="return confirm('Yakin ingin hapus kategori ini?');">
                                              <input type="hidden" name="id" value="<?= $kategori->id ?>">
                                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                          </td>
                                        </tr>
                                      <?php endforeach; ?>
                                    <?php else: ?>
                                      <li class="list-group-item text-muted">Belum ada kategori.</li>
                                    <?php endif; ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updatecollections<?= $collect->id ?>">
                          <i class="bi bi-pencil-square"></i> Update
                        </button>
                        <!-- Update Modal -->
                          <div class="modal fade" id="updatecollections<?= $collect->id ?>" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <form action="<?= base_url('index.php/Product/update_collections') ?>" method="post">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Update Collection</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $collect->id ?>">
                                    <div class="mb-3">
                                      <label class="form-label">Name Collections</label>
                                      <input type="text" class="form-control" name="nama_koleksi" value="<?= $collect->nama_koleksi ?>">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletecollections<?= $collect->id ?>">
                          <i class="bi bi-trash"></i> Delete
                        </button>
                        <!-- Delete Modal -->
                          <div class="modal fade" id="deletecollections<?= $collect->id ?>" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <form action="<?= base_url('index.php/Product/delete_collections') ?>" method="post">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Delete Collection</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $collect->id ?>">
                                    <p>Apakah kamu yakin ingin menghapus koleksi <strong><?= $collect->nama_koleksi ?></strong>?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                      </td>
                    </tr>
                    
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Add Collections Modal -->
<div class="modal fade" id="addcollections" tabindex="-1" data-bs-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Data Collections</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="<?= base_url('index.php/Product/create_collections') ?>" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name Collections</label>
            <input type="text" class="form-control" name="nama_koleksi">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Add Data</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Update -->