<!DOCTYPE html>
<html>
<head>
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Live Search</title>
    <!-- Link to Tailwind CSS instead of Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
    <div class="container mx-auto px-4">
        <div class="row">
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                    <div class="p-8">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Student Information</h3>
                        <div class="mt-2">
                            <input type="text" class="form-input mt-1 block w-full" id="search" name="search" placeholder="Search students..."></input>
                        </div>
                        <table class="min-w-full leading-normal mt-6">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 bg-gray-200 text-left text-xs leading-4 font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                    <th class="px-5 py-3 bg-gray-200 text-left text-xs leading-4 font-semibold text-gray-600 uppercase tracking-wider">Username</th>
                                    <th class="px-5 py-3 bg-gray-200 text-left text-xs leading-4 font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-5 py-3 bg-gray-200 text-left text-xs leading-4 font-semibold text-gray-600 uppercase tracking-wider">Major</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Student data will be dynamically inserted here -->
                                <!-- Example PHP code snippet to insert data -->
                                <?php
                                    // Assuming $students is your data array
                                    foreach ($students as $student) {
                                        echo '<tr>' .
                                            '<td class="border px-4 py-2">' . $student->id . '</td>' .
                                            '<td class="border px-4 py-2">' . $student->username . '</td>' .
                                            '<td class="border px-4 py-2">' . $student->email . '</td>' .
                                            '<td class="border px-4 py-2">' . $student->major . '</td>' .
                                            '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('search') }}',
                data: {'search': $value},
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
</body>
</html>
