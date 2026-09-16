@extends('admin.layout.app')
@section('content')
   <div id="content-wrapper">
            <div class="container-fluid">
               <!-- Breadcrumbs-->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="index.php">Quản lý</a>
                  </li>
                  <li class="breadcrumb-item active">Sản phẩm</li>
               </ol>
               <!-- DataTables Example -->
               <div class="action-bar">
                  <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
                  <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
               </div>
               <div class="card mb-3">
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                              <tr>
                                 <th><input type="checkbox" onclick="checkAll(this)"></th>
                                 <th>Mã</th>
                                 <th style="width:50px">Tên </th>
								         <th>Hình ảnh</th>
                                 <th>Giá bán lẻ</th>
                                 <th>% giảm giá</th>
                                 <th>Giá bán thực tế</th>
                                 <th>Lượng tồn</th>
                                 <th>Đánh giá</th>
                                 <th>Nội bật</th>
                                 <th>Danh mục</th>
                                 <th>Ngày tạo</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>

                                 <td><input type="checkbox"></td>
                                 <td>#25</td>
                                 <td>Kem chống nắng Beaumore - 80ml - giá sỉ​, giá tốt Kem chống nắng Beaumore - 80ml</td>
                                  <td><img src="../../images/suaTamSandrasShowerGel.jpg"></td>
                                 <td>180,000 ₫</td>
                                 <td>10%</td>
                                 <td>166,000 ₫</td>
                                 <td>50</td>
                                 <td>4,8</td>
                                 <td></td>
                                 <td>Kem Trị Thâm Nám </td>
                                 <td>2017-10-16 15:22:00</td>
                                 <td><a href="../../pages/comment/list.html">Đánh giá</a></td>
                                 <td><a href="../../pages/image/list.html">Hình ảnh</a></td>
                                 <td><input type="button" onclick="Edit('25');" value="Sửa" class="btn btn-warning btn-sm"></td>
                                 <td><input type="button" onclick="Delete('25');" value="Xóa" class="btn btn-danger btn-sm"></td>
                              </tr>
                              <tr>

                                 <td><input type="checkbox"></td>
                                 <td>#26</td>
                                 <td>Kem trị mụn nghệ Nhật Beaumore Pure Turmeric Cream (Mới)- 20g </td>
                                  <td><img src="../../images/kemTrangDaLinhChiDongTrungHaThao.jpg"></td>
                                 <td>239,000 ₫</td>
                                 <td>5%</td>
                                 <td>227,000 ₫</td>
                                 <td>20</td>
                                 <td>4,7</td>
                                 <td>Có</td>
                                 <td>Kem Trị Mụn</td>
                                 <td>2017-10-16 14:22:00</td>
                                 <td><a href="../../pages/comment/list.html">Đánh giá</a></td>
                                 <td><a href="../../pages/image/list.html">Hình ảnh</a></td>
                                 <td><input type="button" onclick="Edit('26');" value="Sửa" class="btn btn-warning btn-sm"></td>
                                 <td><input type="button" onclick="Delete('26');" value="Xóa" class="btn btn-danger btn-sm"></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright © Thầy Lộc 2017</span>
                  </div>
               </div>
            </footer>
         </div>
@endsection
