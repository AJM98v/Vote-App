<x-app-layout>
   <div class="filters flex space-x-6">
       <div class="w-1/3">
           <select name="category" id="category" class="w-full rounded-xl px-4 py-2 border-none">
               <option value="Category One">Category One</option>
               <option value="Category Two">Category Two</option>
               <option value="Category three">Category three</option>
               <option value="Category four">Category four</option>
           </select>
       </div>
       <div class="w-1/3">
           <select name="other_filter" id="other_filter" class="w-full rounded-xl px-4 py-2 border-none">
               <option value="Filter One">Filter One</option>
               <option value="Filter Two">Filter Two</option>
               <option value="Filter three">Filter three</option>
               <option value="Filter four">Category four</option>
           </select>
       </div>
       <div class="w-2/3 relative">
           <div class="absolute top-0 flex items-center h-full ml-2">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
               </svg>
           </div>

           <input type="search" placeholder="Find Ideas" class="placeholder-gray-900 rounded-xl border-none w-full bg-white px-4 py-2 pl-10">
       </div>



   </div>
{{--    end filters--}}
</x-app-layout>
