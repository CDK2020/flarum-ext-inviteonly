<?php namespace Davis\InviteOnly\Repository;

use Davis\InviteOnly\Referal;
use Illuminate\Database\Eloquent\Builder;

class ReferalRepository
{
    public function query()
    {
        return Referal::query();
    }
    public function findOrFail($token)
    {
        return Referal::where('token', $token)->firstOrFail();
    }
    public function findUsersToken($id)
    {
        return Referal::where('referrer', $id)->orderBy('id', 'asc')
            ->take(100)
            ->get();
    }
    public function useCode($token, $actorId)
    {
        $referal = $this->findOrFail($token);
        $useNum = $referal->used;
        $useNum++;
        $referal->used = $useNum;
        $referal->save();
        return $ref;
    }
    public function createCode($id, $actorId $actorName) 
    {
        $referal = new Referal;
        $referal->referrer = $actorId;
        $referal->token = $actorName;
        if (Referal::where('token', $referal->token)->exists()) {
            $referal->token = $actorName;
        }
        $referal->created_at = date( 'Y-m-d H:i:s');
        $referal->used = 0;

        $referal->save();

        return $referal;
    }
    public function countCodes($id)
    {
        return Referal::where('referrer', $id)->where('used', 0)
            ->get()
            ->count();
    }
}
