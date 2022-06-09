  <!-- Main Sidebar Container -->
  @if (auth('admin')->user()->type == 'Admin')
  <?php $name = 'Admin' ?>
 @else
 <?php $name = 'User' ?>
 @endif
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  <a href="{{route('admin.dashboard')}}" class="brand-link">
      {{-- <img src="{{asset('image/admin_image/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
      {{-- <span class="brand-text font-weight-light">Admin | Dashboard</span> --}}
      <div class="image">
        <img src="{{asset(Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
      </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
          @if(Session::get('page')=="dashboard")
           <?php $active = "active"; ?>
            @else
            <?php $active = ""; ?>
          @endif
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard 
              </p>
            </a>
          </li>
          @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(26)|| auth('admin')->user()->hasPermission(27) 
          || auth('admin')->user()->hasPermission(28) || auth('admin')->user()->hasPermission(29) || auth('admin')->user()->hasPermission(32))

            @if(Session::get('page')=="dfd" || Session::get('page')=="kitchen" || Session::get('page')=="caffe" || Session::get('page')=="bar" || Session::get('page')=="waiter" )
            <?php $active = "active";
            $menuOpen="menu-open"; ?>
              @else
              <?php $active = "";
              $menuOpen=""; ?>
            @endif
            <li class="nav-item has-treeview {{$menuOpen ??''}} ">
              <a href="#" class="nav-link {{$active}}">
                <i class="fa fa-desktop" aria-hidden="true"></i>
                <p>
                  All Screen
                  <i class="fas fa-angle-left right"></i>
                  <span class="right badge badge-danger"></span>
                </p>
              </a>

              @if(Session::get('page')=="dfdf")
            <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <ul class="nav nav-treeview">
              @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(26))
                <li class="nav-item">
                  <a href="{{route('admin.add.edit.sale')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>POS</p>
                  </a>
                </li>
              @endif
              @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(27))

                @if(Session::get('page')=="kitchen")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.kitchen')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kitchen</p>
                  </a>
                </li>
              @endif
              @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(28))
                @if(Session::get('page')=="caffe")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.caffe')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Caffe</p>
                  </a>
                </li>

              @endif
              @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(29))

                @if(Session::get('page')=="bar")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.bar')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bar</p>
                  </a>
                </li>
                @endif
                @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(32))

                @if(Session::get('page')=="waiter")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.waiter.collect.food')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Waiter</p>
                  </a>
                </li>
              @endif
              </ul>
            </li>
          @endif
          {{-- end pos section  --}}
          @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(54))
              @if(Session::get('page')=="billing"  )
              <?php $active = "active";
              $menuOpen="menu-open"; ?>
               @else
               <?php $active = "";
               $menuOpen=""; ?>
             @endif
             <li class="nav-item ">
              <a href="{{route('admin.billing')}}" class="nav-link {{$active}}">
                <i class="fa fa-file-invoice" aria-hidden="true"></i>
                <p>
                  Billing
                </p>
              </a>
            </li>
        @endif
        @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(55))
            @if(Session::get('page')=="room"  )
            <?php $active = "active";
            $menuOpen="menu-open"; ?>
             @else
             <?php $active = "";
             $menuOpen=""; ?>
            @endif
            <li class="nav-item ">
              <a href="{{route('admin.room')}}" class="nav-link {{$active}}">
                <i class="fas fa-bed"></i>            
                <p>
                   Room
                </p>
              </a>
            </li>
        @endif
        @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(56))
            @if(Session::get('page')=="bookRoom"  )
            <?php $active = "active";
            $menuOpen="menu-open"; ?>
             @else
             <?php $active = "";
             $menuOpen=""; ?>
           @endif
            <li class="nav-item ">
              <a href="{{route('admin.book.room')}}" class="nav-link {{$active}}">
                <i class="fas fa-bed	"></i>            
                <p>
                  Book Room
                </p>
              </a>
            </li>
        @endif
        @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(57))
            @if(Session::get('page')=="swimming_pool"  )
            <?php $active = "active";
            $menuOpen="menu-open"; ?>
             @else
             <?php $active = "";
             $menuOpen=""; ?>
           @endif
            <li class="nav-item ">
              <a href="{{route('admin.swimming.pool')}}" class="nav-link {{$active}}">
                <i class="fas fa-swimming-pool"></i>            
                <p>
                  Swimming Pool
                </p>
              </a>
            </li>
        @endif
        @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(58))
            @if(Session::get('page')=="rafting"  )
            <?php $active = "active";
            $menuOpen="menu-open"; ?>
             @else
             <?php $active = "";
             $menuOpen=""; ?>
            @endif
            <li class="nav-item ">
              <a href="{{route('admin.rafting')}}" class="nav-link {{$active}}">
                <i class="fab fa-red-river"></i>            
                <p>
                   Rafting
                </p>
              </a>
            </li>
        @endif
        @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(59))
            @if(Session::get('page')=="tent"  )
            <?php $active = "active";
            $menuOpen="menu-open"; ?>
             @else
             <?php $active = "";
             $menuOpen=""; ?>
           @endif
            <li class="nav-item ">
              <a href="{{route('admin.tent')}}" class="nav-link {{$active}}">
                <i class="fab fa-red-river"></i>            
                <p>
                   Tent
                </p>
              </a>
            </li>
        @endif
        @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(60))
            @if(Session::get('page')=="rent_tent"  )
            <?php $active = "active";
            $menuOpen="menu-open"; ?>
             @else
             <?php $active = "";
             $menuOpen=""; ?>
            @endif
            <li class="nav-item ">
              <a href="{{route('admin.rent.tent')}}" class="nav-link {{$active}}">
                <i class="fab fa-red-river"></i>            
                <p>
                   Camping
                </p>
              </a>
            </li>
        @endif

            @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(33)|| auth('admin')->user()->hasPermission(34) 
            || auth('admin')->user()->hasPermission(35) || auth('admin')->user()->hasPermission(36) || auth('admin')->user()->hasPermission(37)
            || auth('admin')->user()->hasPermission(38)|| auth('admin')->user()->hasPermission(39)|| auth('admin')->user()->hasPermission(40)
            || auth('admin')->user()->hasPermission(41)|| auth('admin')->user()->hasPermission(42))
    
              @if(Session::get('page')=="ingredientCategory" || Session::get('page')=="ingredientUnit" || Session::get('page')=="ingredientItem" 
              || Session::get('page')=="foodCategory" || Session::get('page')=="foodMenu"  || Session::get('page')=="customer" || Session::get('page')=="supplier" 
               || Session::get('page')=="table" || Session::get('page')=="paymentMethod" || Session::get('page')=="expense"
              )
              <?php $active = "active";
              $menuOpen="menu-open"; ?>
               @else
               <?php $active = "";
               $menuOpen=""; ?>
              @endif
                <li class="nav-item has-treeview {{$menuOpen ??''}} ">
                  <a href="#" class="nav-link {{$active}}">
                    <i class="fas fa-file"></i>                
                    <p>
                      Master
                      <i class="fas fa-angle-left right"></i>
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(33))
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="ingredientCategory")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.ingredientCategory')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Ingredient Category </p>
                      </a>
                    </li>
                  </ul>
                  @endif
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(34))
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="ingredientUnit")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.ingredientUnit')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Ingredient Units </p>
                      </a>
                    </li>
                  </ul>
                  @endif
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(35))
          
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="ingredientItem")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.ingredientItem')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Ingredient Items</p>
                      </a>
                    </li>
                  </ul>
                  @endif
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(36))
                  
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="foodCategory")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.foodCategory')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Food Category</p>
                      </a>
                    </li>
                  </ul>
                  @endif
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(37))
    
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="foodMenu")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.foodMenu')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Food Menu</p>
                      </a>
                    </li>
                  </ul>
                  @endif
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(38))
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="customer")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.customer')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Customers</p>
                      </a>
                    </li>
                  </ul>
                  @endif
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(39))
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="supplier")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.supplier')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Suppliers</p>
                      </a>
                    </li>
                  </ul>
                  @endif
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(40))
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="expense")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.expense')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Expanse</p>
                      </a>
                    </li>
                  </ul>
                  @endif
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(41))
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="paymentMethod")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.paymentMethod')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Payment Methods</p>
                      </a>
                    </li>
                  </ul>
                  @endif
                  @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(42))
                  <ul class="nav nav-treeview">
                    @if(Session::get('page')=="table")
                    <?php $active = "active"; ?>
                    @else
                    <?php $active = ""; ?>
                    @endif
                    <li class="nav-item">
                      <a href="{{route('admin.table')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tables</p>
                      </a>
                    </li>
                  </ul>
                  @endif
                </li>
            @endif
            {{-- end master  --}}
    
            @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(43))
              @if(Session::get('page')=="purchase")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.purchase')}}" class="nav-link {{$active}}">
                  <i class="fa fa-truck" aria-hidden="true"></i>
                  <p>
                    Purchase
                  </p>
                </a>
              </li>
            @endif
    
            @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(44))
              @if(Session::get('page')=="sale")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.sale')}}" class="nav-link {{$active}}">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  <p>
                    Sale
                  </p>
                </a>
              </li>
            @endif
    
            @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(47))
              @if(Session::get('page')=="waste")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.waste')}}" class="nav-link {{$active}}">
                  <i class="fas fa-dollar-sign"></i>
                    <p>
                    Waste
                  </p>
                </a>
              </li>
            @endif
    
    
            @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(48))
              @if(Session::get('page')=="supplierDeuPayment")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.view.supplier.deu.payments')}}" class="nav-link {{$active}}">
                  <i class="fas fa-dollar-sign"></i>          
                  <p>
                    Supplier Due Payments
                  </p>
                </a>
              </li>
            @endif
    
    
            @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(49))
              @if(Session::get('page')=="customerDeuReceives")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
              @endif
            <li class="nav-item">
              <a href="{{route('admin.view.customer.deu.receives')}}" class="nav-link {{$active}}">
                <i class="fas fa-dollar-sign"></i>            <p>
                  Customer Due Receives
                </p>
              </a>
            </li>
          @endif
    
          {{-- start Employe Management  --}}
          @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(50))
    
            @if(Session::get('page')=="admin_task_view" || Session::get('page')=="attendance" || Session::get('page')=="task" || Session::get('page')=="leave" 
            || Session::get('page')=="salary" || Session::get('page')=="add_leave")
            <?php $active = "active";
            $menuOpen="menu-open"; ?>
             @else
             <?php $active = "";
             $menuOpen=""; ?>
           @endif
           <li class="nav-item has-treeview {{$menuOpen ??''}} ">
             <a href="#" class="nav-link {{$active}}">
              <i class="fas fa-user-plus"></i><p>
                Employe Management
                 <i class="fas fa-angle-left right"></i>
                 <span class="right badge badge-danger"></span>
               </p>
             </a>
             <ul class="nav nav-treeview">
              @if(Session::get('page')=="attendance")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.attendance')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="admin_task_view")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              @if (auth('admin')->user()->type=='Admin')
              <li class="nav-item">
                <a href="{{route('admin.view.task')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Task</p>
                </a>
              </li>
            </ul>
              @else
              <ul class="nav nav-treeview">
                @if(Session::get('page')=="task")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.task')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Task</p>
                  </a>
                </li>
              </ul>
              @endif
    
              @if (auth('admin')->user()->type=="Admin")
              
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="leave")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.leave')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>leave</p>
                </a>
              </li>
            </ul>
                  
              @else
              <ul class="nav nav-treeview">
                @if(Session::get('page')=="add_leave")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.add.edit.leave')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add leave</p>
                  </a>
                </li>
              </ul>
              @endif
           
          
    
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="salary")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.view.salary')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>salary</p>
                </a>
              </li>
            </ul>
           </li>
           @endif
           {{-- end Employe Management section  --}}
           
    
           {{-- start account section  --}}
           @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(52))
    
           @if(Session::get('page')=="taxVat" || Session::get('page')=="bankDeposit"
           || Session::get('page')=="bank" || Session::get('page')=="cashHand"
           || Session::get('page')=="income" || Session::get('page')=="assets")
            <?php $active = "active";
     
            $menuOpen="menu-open"; ?>
             @else
             <?php $active = "";
             $menuOpen=""; ?>
           @endif
           <li class="nav-item has-treeview {{$menuOpen ??''}} ">
             <a href="#" class="nav-link {{$active}}">
    
              <i class="fas fa-user-circle"></i>           
              <p>
                Accounts
                 <i class="fas fa-angle-left right"></i>
                 <span class="right badge badge-danger"></span>
               </p>
             </a>
    
          
    
            
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="taxVat")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.taxVat')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tax And Vat</p>
                </a>
              </li>
            </ul>
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="bankDeposit")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.bankDeposit')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Deposit Into Bank</p>
                </a>
              </li>
            </ul>
    
            
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="bank")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.bank')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank</p>
                </a>
              </li>
            </ul>
    
               
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="cashHand")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.cashHand')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cash In Hand</p>
                </a>
              </li>
            </ul>
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="liabilities")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.liabilities')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liabilities</p>
                </a>
              </li>
            </ul>
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="income")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.income')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Income</p>
                </a>
              </li>
            </ul>
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="assets")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.assets')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assets</p>
                </a>
              </li>
            </ul>
    
           </li>
           @endif
           {{-- end account report  --}}
           
        {{-- start report section  --}}
        @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(51))
    
            @if(Session::get('page')=="pl_account" || Session::get('page')=="daily_sale_report" || Session::get('page')=="waste_report" || Session::get('page')=="purchase_report"
            || Session::get('page')=="attendance_report" || Session::get('page')=="sale_report" || Session::get('page')=="stock_report" || Session::get('page')=="consumption_report" || Session::get('page')=="low_inventory_report"
            || Session::get('page')=="leave_report" || Session::get('page')=="salary_report" || Session::get('page')=="tax_report" || Session::get('page')=="salary_report" || Session::get('page')=="task_report")
    
    
            <?php $active = "active";
            $menuOpen="menu-open"; ?>
             @else
             <?php $active = "";
             $menuOpen=""; ?>
           @endif
           <li class="nav-item has-treeview {{$menuOpen ??''}} ">
             <a href="#" class="nav-link {{$active}}">
              <i class="fa fa-file" aria-hidden="true"></i>
               <p>
                Reports
                 <i class="fas fa-angle-left right"></i>
                 <span class="right badge badge-danger"></span>
               </p>
             </a>
             <ul class="nav nav-treeview">
              @if(Session::get('page')=="pl_account")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.pl.account.report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PL Account Report</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="daily_sale_report")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.daily.summary.report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily Summary Report</p>
                </a>
              </li>
            </ul>
             <ul class="nav nav-treeview">
              @if(Session::get('page')=="waste_report")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.waste.report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Waste Report</p>
                </a>
              </li>
            </ul>
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="purchase_report")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.purchase.report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Report</p>
                </a>
              </li>
            </ul>
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="attendance_report")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.attendance.report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance Report</p>
                </a>
              </li>
            </ul>
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="sale_report")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.sale.report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sale Report</p>
                </a>
              </li>
            </ul>
        
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="stock_report")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.stock.report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="consumption_report")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.consumption.report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consumption Report</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="low_inventory_report")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.low.inventory.report')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Low Inventory Report</p>
                </a>
              </li>
            </ul>
          
              <ul class="nav nav-treeview">
                @if(Session::get('page')=="leave_report")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.leave.report')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Leave Report</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                @if(Session::get('page')=="salary_report")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.salary.report')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Salary Report</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                @if(Session::get('page')=="tax_report")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.tax.report')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tax Report</p>
                  </a>
                </li>
              </ul>
    
              <ul class="nav nav-treeview">
                @if(Session::get('page')=="task_report")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                  <a href="{{route('admin.task.report')}}" class="nav-link {{$active}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Task Report</p>
                  </a>
                </li>
              </ul>
           </li>
           @endif
           {{-- end report section  --}}
          
           {{-- here is miscellaneous --}}
           @if (auth('admin')->user()->type == 'Admin' || auth('admin')->user()->hasPermission(53))
               
           @if(Session::get('page')=="electricity" || Session::get('page')=="internet" || Session::get('page')=="water")
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen=""; ?>
          @endif
          <li class="nav-item has-treeview {{$menuOpen ??''}} ">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-th"></i>          
              <p>
               Miscellaneous
                <i class="fas fa-angle-left right"></i>
                <span class="right badge badge-danger"></span>
              </p>
            </a>
    
              @if(Session::get('page')=="payments")
            <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
          
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="electricity")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.electricity')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Electricity Consumption</p>
                </a>
              </li>
            </ul>
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="internet")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.internet')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Internet Consumption</p>
                </a>
              </li>
            </ul>
    
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="water")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.water')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Water Consumption</p>
                </a>
              </li>
            </ul>
    
          </li>
          @endif
    
          {{-- miscellaneous ends here --}}
    
           @if(Session::get('page')=="setting" || Session::get('page')=="updateAdminDetail" || Session::get('page')=="admin_roles" )
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen=""; ?>
          @endif
          <li class="nav-item has-treeview {{$menuOpen ??''}} ">
            <a href="#" class="nav-link {{$active}}">
              <i class="fas fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
                <span class="right badge badge-danger"></span>
              </p>
            </a>
    
            @if(Session::get('page')=="setting")
           <?php $active = "active"; ?>
            @else
            <?php $active = ""; ?>
            @endif
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.settings')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update User Password</p>
                </a>
              </li>
              @if(Session::get('page')=="updateAdminDetail")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.update.admin.details')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update {{$name}} Details</p>
                </a>
              </li>
              @if (auth('admin')->user()->type == 'Admin')
    
               @if(Session::get('page')=="admin_roles")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.user')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
            </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>

