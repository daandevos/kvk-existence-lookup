<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KVK existence lookup</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="container py-4 mx-auto">
            <div class="mx-auto w-full md:w-1/2 overflow-hidden shadow border border-gray-200 rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h1 class="text-lg font-semibold mb-6">KVK Lookup</h1>
                    <form method="POST" action="/lookup">
                        @csrf
                        <div>
                            <label for="numbers" class="block text-sm font-medium text-gray-700">KVK numbers <small class="text-gray-400">(new line separated)</small></label>
                            <div class="mt-1">
                                <textarea rows="4" name="numbers" id="numbers" class="p-2 border shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                        </div>
                        <div class="mt-2 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Lookup
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
