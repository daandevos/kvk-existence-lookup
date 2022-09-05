<?php

namespace App\Http\Controllers;

use App\Http\Requests\LookupRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Throwable;

class LookupController extends Controller
{
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
                $response = Http::withHeaders([
                    'apiKey' => config('kvk.key'),
                ])->get(config('kvk.url'), $queries);

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
