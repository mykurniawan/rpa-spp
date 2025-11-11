            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p><?php echo date('Y'); ?> &copy; MI Al-Huda</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="#">rpa</a></p>
                    </div>
                </div>
            </footer>
            </div>
            </div>
            <script src="/rpa-spp/assets/static/js/components/dark.js"></script>
            <script src="/rpa-spp/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
            <script src="/rpa-spp/assets/compiled/js/app.js"></script>
            <!-- Need: Apexcharts -->
            <script src="/rpa-spp/assets/extensions/apexcharts/apexcharts.min.js"></script>
            <script src="/rpa-spp/assets/static/js/pages/dashboard.js"></script>
            <script src="/rpa-spp/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
          
            <!-- pindah nanti  -->
           <style>
                /* Custom datatable pagination style */
                .dataTable-pagination {
                    display: flex;
                    justify-content: flex-end;
                    margin-top: 10px;
                }

                .dataTable-pagination-list {
                    display: flex;
                    gap: 8px;
                    list-style: none;
                    padding-left: 0;
                }

                .dataTable-pagination-list li {
                    display: inline-block;
                }

                .dataTable-pagination-list li a {
                    display: block;
                    padding: 4px 10px;
                    border-radius: 4px;
                    background: #22223b;
                    color: #fff;
                    text-decoration: none;
                    transition: background 0.2s;
                }

                .dataTable-pagination-list li.active a,
                .dataTable-pagination-list li a:hover {
                    background: #4f4fa6;
                }
                /* Custom datatable entries per page dropdown */
                .dataTable-dropdown label {
                    color: #fff;
                    font-size: 1rem;
                    margin-right: 8px;
                }
                .dataTable-selector {
                    background: #22223b;
                    color: #fff;
                    border: 1px solid #4f4fa6;
                    border-radius: 6px;
                    padding: 6px 18px;
                    font-size: 1rem;
                    margin-right: 8px;
                    outline: none;
                    transition: border 0.2s;
                }
                .dataTable-selector:focus {
                    border-color: #7c7cf0;
                }
                /* Custom datatable search bar */
                .dataTable-search input.dataTable-input {
                    background: #22223b;
                    color: #fff;
                    border: 1px solid #4f4fa6;
                    border-radius: 6px;
                    padding: 8px 16px;
                    font-size: 1rem;
                    margin-top: 8px;
                    outline: none;
                    width: 100%;
                    box-sizing: border-box;
                    transition: border 0.2s;
                }
                .dataTable-search input.dataTable-input:focus {
                    border-color: #7c7cf0;
                }
            </style>
            <!-- pindah nanti  -->

            <script>
                // Inisialisasi datatable
                document.addEventListener('DOMContentLoaded', function() {
                    var table = document.querySelector('#table1');
                    if (table) {
                        new simpleDatatables.DataTable(table);
                    }
                });
            </script>

            </body>

            </html>