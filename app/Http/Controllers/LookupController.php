<?php

namespace App\Http\Controllers;

use App\Http\Requests\LookupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Throwable;

class LookupController extends Controller
{
    private const KVK_API_URL = 'https://developers.kvk.nl/test/api/v1/zoeken';

    public function __invoke(LookupRequest $request)
    {
        $result = [];
        foreach ($request->numbers() as $number) {
            $queries = http_build_query([
                'kvkNummer' => $number,
                'pagina'    => 1,
                'aantal'    => 10,
            ]);

            try {
                $response = Http::get(self::KVK_API_URL, $queries);

                $result[$number] = true;

                if (!$response->successful()) {
                    $result[$number] = false;
                }
            } catch (Throwable $exception) {
                ValidationException::withMessages([
                    'numbers' => $exception->getMessage(),
                ]);
            }
        }

        return redirect()->back()->with([
            'result' => $result,
        ]);
    }
}
