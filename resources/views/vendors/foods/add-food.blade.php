<x-vendor-app-layout>
    <div class="mt-10 pt-10 text-red-500 text-center">
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="mt-4 px-8 md:w-2/3 mx-auto justify-center pb-4">
        <form action="{{route('vendor.store-food')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="food_name" id="food_name" value="{{old('food_name')}}" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" " required />
                <label for="food_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Food Item Name</label>
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <select name="category_id" id="category_id" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent dark:bg-gray-800 border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-200 dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer">
                    <option value="">Select Food Category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{'* '.$category->name}}</option>
                    @if ($category->children->isNotEmpty())
                    @foreach ($category->children as $subcategory)
                    <option value="{{$subcategory->id}}">{{'***** '. $subcategory->name}}</option>
                    @endforeach
                    @endif
                    @endforeach
                </select>

            </div>

            <div class="relative z-0 w-full mb-6 group">
                <input type="file" name="featured_image" id="featured_image" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" " required />
                <label for="featured_image" class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Food Featured Image</label>
                <img id="featured_image_preview" class="mt-2 w-60" src="#" alt="Featured Image Preview" style="display: none;" />
              </div>
              <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                  <input type="file" name="first_image" id="first_image" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" "/>
                  <label for="first_image" class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Add Food Image (optional)</label>
                  <img id="first_image_preview" class="mt-2 w-60" src="#" alt="First Image Preview" style="display: none;" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                  <input type="file" name="second_image" id="second_image" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" "  />
                  <label for="second_image" class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Add Food Image (optional)</label>
                  <img id="second_image_preview" class="mt-2 w-60" src="#" alt="Second Image Preview" style="display: none;" />
                </div>
              </div>
              <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                  <input type="file" name="third_image" id="third_image" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" "  />
                  <label for="third_image" class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Add Food Image (optional)</label>
                  <img id="third_image_preview" class="mt-2 w-60" src="#" alt="Third Image Preview" style="display: none;" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                  <input type="file" name="fourth_image" id="fourth_image" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" " />
                  <label for="fourth_image" class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Add Food Image (optional)</label>
                  <img id="fourth_image_preview" class="mt-2 w-60" src="#" alt="Fourth Image Preview" style="display: none;" />
                </div>
              </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="unit_amount" id="unit_amount" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" " required />
                    <label for="unit_amount" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Quantity</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                  <select name="unit_name" id="unit_name" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent dark:bg-gray-800 border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-200 dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer">
                      <option value="">Select Unit Name</option>
                      @foreach ($units as $unit)
                      <option value="{{$unit->unit_name}}">* {{$unit->unit_name}}</option>
                      @endforeach
                  </select>
                </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="price" id="price" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" " required />
                    <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                  <input type="text" name="discount" id="discount" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" " required />
                  <label for="discount" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Discount(%)</label>
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                {{-- <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="final_price" id="final_price" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" " readonly />
                    <label for="final_price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Final Price</label>
                </div> --}}
                <div class="relative z-0 w-full mb-6 group">
                  <input type="number" name="available_quantity" id="available_quantity" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer" placeholder=" " required />
                  <label for="available_quantity" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Availability</label>
                </div>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <textarea name="description" rows="7" id="description" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-400 peer">Write description...</textarea>
                {{-- <label for="description" class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Food Item Details</label> --}}
            </div>

            <button type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-500 dark:focus:ring-green-600">Submit</button>
          </form>
    </div>
    {{-- <script>
        // Get the input elements
        const priceInput = document.getElementById('price');
        const discountInput = document.getElementById('discount');
        const finalPriceInput = document.getElementById('final_price');

        // Add event listeners for input changes
        priceInput.addEventListener('input', calculateFinalPrice);
        discountInput.addEventListener('input', calculateFinalPrice);

        // Function to calculate the final price
        function calculateFinalPrice() {
        const price = parseFloat(priceInput.value);
        const discount = parseFloat(discountInput.value) || 0; // Default discount value is 0

        const finalPrice = price - (price * discount / 100);

        // Update the final price input value
        finalPriceInput.value = isNaN(finalPrice) ? '' : finalPrice.toFixed(2);
    }

    </script> --}}

    <script>
        // Add event listeners to file input fields
        document.getElementById('featured_image').addEventListener('change', previewImage);
        document.getElementById('first_image').addEventListener('change', previewImage);
        document.getElementById('second_image').addEventListener('change', previewImage);
        document.getElementById('third_image').addEventListener('change', previewImage);
        document.getElementById('fourth_image').addEventListener('change', previewImage);

        // Function to handle image preview
        function previewImage(event) {
        const input = event.target;
        const previewId = input.id + '_preview';
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
            preview.setAttribute('src', e.target.result);
            preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
        }

    </script>

    <script>
        tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ]
        });
    </script>

</x-vendor-app-layout>
