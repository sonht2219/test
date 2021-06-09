<?php


namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Exception;

trait Transaction
{
    /**
     * @param callable $tryCallback
     * @param callable|null $catchCallback
     * @throws Exception
     */
    public function useTransaction(callable $tryCallback, callable $catchCallback = null) {
        try {
            DB::beginTransaction();
            $result = $tryCallback();
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            if ($catchCallback) $catchCallback($e);
            throw $e;
        }
    }
}
