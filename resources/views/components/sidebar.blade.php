       <div class="fixed inset-0 z-40 bg-black bg-opacity-50 transition-opacity md:hidden" x-show="sidebarOpen"
           @click="sidebarOpen = false"></div>

       <!-- Sidebar -->
       <!-- Sidebar -->
       <aside
           class="fixed z-50 inset-y-0 left-0 w-64 bg-white shadow-lg transform transition-transform duration-300 md:relative md:translate-x-0 md:block"
           :class="{ '-translate-x-full': !sidebarOpen }">
           <!-- Header -->
           <div class="p-6 bg-gray-800 border-b border-gray-200 flex items-center gap-2">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                   stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                       d="M9.75 3.5h4.5M3.75 7.5h16.5m-15 4.5h13.5m-12 4.5h10.5M6 20h12" />
               </svg>
               <h2 class="text-2xl font-bold text-gray-100">Dashboard</h2>
           </div>

           <!-- Navigation -->
           <nav class="p-4 space-y-2">

               <a href="/dashboard"
                   class="flex items-center gap-2 p-2 rounded
   {{ Request::is('dashboard') ? 'bg-gray-200 text-gray-900 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                       stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                   </svg>
                   <span>Home</span>
               </a>


               <a href="/dashboard/posts"
                   class="flex items-center gap-2 p-2 rounded
   {{ Request::is('dashboard/posts*') ? 'bg-gray-200 text-gray-900 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                   <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                       height="24" fill="none" viewBox="0 0 24 24">
                       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                   </svg>
                   <span>Posts</span>
               </a>




               <!-- Logout Button (POST) -->
               <!-- Alpine state untuk modal -->
               <div x-data="{ showLogoutConfirm: false }">

                   <!-- Tombol Logout -->
                   <button @click="showLogoutConfirm = true"
                       class="flex items-center gap-2 text-red-600 hover:bg-red-100 p-2 rounded w-full text-left">
                       <!-- Logout Icon -->
                       <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                           stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                               d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                       </svg>
                       <span>Logout</span>
                   </button>

                   <!-- Modal Konfirmasi -->
                   <div x-show="showLogoutConfirm" x-cloak
                       class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                       <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full space-y-4">
                           <h2 class="text-lg font-semibold text-gray-800">Yakin ingin keluar?</h2>
                           <p class="text-sm text-gray-600">Anda akan keluar dari sesi sekarang.</p>
                           <div class="flex justify-end gap-2">
                               <button @click="showLogoutConfirm = false"
                                   class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 rounded">Batal</button>
                               <form action="/logout" method="POST">
                                   @csrf
                                   <button type="submit"
                                       class="px-4 py-2 text-sm bg-red-600 text-white hover:bg-red-700 rounded">
                                       Keluar
                                   </button>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>



               @can('admin')
               <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                   <span>Administrator</span>
               </h6>
               <a href="/dashboard/categories"
                   class="flex items-center gap-2 p-2 rounded
   {{ Request::is('dashboard/categories*') ? 'bg-gray-200 text-gray-900 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                   <svg class="w-5 h-5" aria-hidden="true"
                       xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                       viewBox="0 0 24 24">
                       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M9.143 4H4.857A.857.857 0 0 0 4 4.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 10 9.143V4.857A.857.857 0 0 0 9.143 4Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 20 9.143V4.857A.857.857 0 0 0 19.143 4Zm-10 10H4.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286A.857.857 0 0 0 9.143 14Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z" />
                   </svg>

                   <span>Post Categories</span>
               </a>
               @endcan

           </nav>
       </aside>
