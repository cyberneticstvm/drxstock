 <!-- sidebar tab menu -->
 <div class="sidebar px-3 py-1">
     <div class="d-flex flex-column h-100">
         <h5 class="sidebar-title mb-4 mt-2">DRX<span> - Administrator</span></h5>
         <!-- Menu: main ul -->
         <ul class="menu-list flex-grow-1">
             <li><a class="m-link {{ in_array(Route::currentRouteName(), ['dashboard']) ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['order', 'order.fetch']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-order" href="#"><i class="fa fa-check-square-o"></i> <span>Order</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-order')
                    ->link(route('order'), 'Fetch Order')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['user.register', 'user.create', 'user.edit']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-user" href="#"><i class="fa fa-user"></i> <span>User</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-user')
                    ->linkIfCan('user-list', route('user.register'), 'User Register')->addItemClass('ms-link')
                    ->linkIfCan('user-create', route('user.create'), 'Create User')->addItemClass('ms-link')
                }}

             </li>

             <li class="collapsed">
                <a class="m-link {{ in_array(Route::currentRouteName(), ['role.register', 'role.create', 'role.edit']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-role" href="#"><i class="fa fa-lock"></i> <span>Role</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-role')
                    ->linkIfCan('role-list', route('role.register'), 'Role Register')->addItemClass('ms-link')
                    ->linkIfCan('rol-create', route('role.create'), 'Create Role')->addItemClass('ms-link')
                }}

             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['category.register', 'category.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-category" href="#"><i class="fa fa-bars"></i> <span>Category</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-category')
                    ->linkIfCan('category-list', route('category.register'), 'Category Register')->addItemClass('ms-link')
                    ->linkIfCan('category-create', route('category.create'), 'Create Category')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['type.register', 'type.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-type" href="#"><i class="fa fa-bookmark"></i> <span>Type</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-type')
                    ->linkIfCan('product-type-list', route('type.register'), 'Type Register')->addItemClass('ms-link')
                    ->linkIfCan('product-type-create', route('type.create'), 'Create Type')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['material.register', 'material.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-material" href="#"><i class="fa fa-crop"></i> <span>Material</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-material')
                    ->linkIfCan('material-list', route('material.register'), 'Material Register')->addItemClass('ms-link')
                    ->linkIfCan('material-create', route('material.create'), 'Create Material')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['coating.register', 'coating.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-coating" href="#"><i class="fa fa-paint-brush"></i> <span>Coating</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-coating')
                    ->linkIfCan('coating-list', route('coating.register'), 'Coating Register')->addItemClass('ms-link')
                    ->linkIfCan('coating-create', route('coating.create'), 'Create Coating')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['product.register', 'product.create', 'product.track', 'product.export']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#"><i class="fa fa-cubes"></i> <span>Product</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-product')
                    ->linkIfCan('product-list', route('product.register'), 'Product Register')->addItemClass('ms-link')
                    ->linkIfCan('product-create', route('product.new'), 'create Product')->addItemClass('ms-link')
                    ->linkIfCan('product-create', route('product.create'), 'Import Product')->addItemClass('ms-link')
                    ->linkIfCan('product-export-excel', route('product.export'), 'Export Product')->addItemClass('ms-link')
                    ->linkIfCan('product-track', route('product.track'), 'Track Product')->addItemClass('ms-link')
                    ->linkIfCan('product-create', route('product.export.excel.shelf.box'), 'Shelf, and Box Bulk Update')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['supplier.register', 'supplier.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-supplier" href="#"><i class="fa fa-tags"></i> <span>Supplier</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-supplier')
                    ->linkIfCan('supplier-list', route('supplier.register'), 'Supplier Register')->addItemClass('ms-link')
                    ->linkIfCan('supplier-create', route('supplier.create'), 'Create Supplier')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['purchase.register', 'purchase.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-purchase" href="#"><i class="fa fa-shopping-cart"></i> <span>Purchase</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-purchase')
                    ->linkIfCan('purchase-list', route('purchase.register'), 'Purchase Register')->addItemClass('ms-link')
                    ->linkIfCan('purchase-create', route('purchase.create'), 'Create Purchase')->addItemClass('ms-link')
                    ->linkIfCan('purchase-import', route('purchase.import'), 'Import Purchase')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['sales.register', 'sales.create']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-sales" href="#"><i class="fa fa-usd"></i> <span>Sales / Transfer</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-sales')
                    ->linkIfCan('sales-list', route('sales.register'), 'Sales Register')->addItemClass('ms-link')
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['damage.register', 'damage.create', 'damage.edit']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-sales" href="#"><i class="fa fa-bolt"></i> <span>Damage</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-sales')
                    ->linkIfCan('damage-list', route('damage.register'), 'Damage Register')->addItemClass('ms-link')
                    ->linkIfCan('damage-create', route('damage.create'), 'Create Damage')->addItemClass('ms-link');
                }}
             </li>

             <li class="collapsed">
                 <a class="m-link {{ in_array(Route::currentRouteName(), ['report.sales', 'report.sales.fetch', 'report.purchase', 'report.purchase.fetch', 'report.damage', 'report.damage.fetch']) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-sales" href="#"><i class="fa fa-file-text-o"></i> <span>Reports</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>

                 <!-- Menu: Sub menu ul -->
                 {{
                    Menu::new()->addClass('sub-menu collapse')->setAttribute('id', 'menu-sales')
                    ->linkIfCan('report-sales', route('report.sales'), 'Sales / Transfer')->addItemClass('ms-link')
                    ->linkIfCan('report-sales-product-wise', route('report.sales.product'), 'Sales (Product)')->addItemClass('ms-link')
                    ->linkIfCan('report-purchase', route('report.purchase'), 'Purchase')->addItemClass('ms-link')
                    ->linkIfCan('report-damage', route('report.damage'), 'Damage')->addItemClass('ms-link');
                }}
             </li>

         </ul>
         <!-- Menu: menu collepce btn -->
         <button type="button" class="btn btn-link text-primary sidebar-mini-btn">
             <span><i class="fa fa-arrow-left"></i></span>
         </button>
     </div>
 </div>