<?php

namespace Services\Institute\Repositories;


use App\Repository\Repository;
use Illuminate\Support\Facades\DB;
use Services\Institute\Models\InstituteBoardMember;

/**
 * InstituteBoardMember
 * @author Sajadweb
 * Thu Dec 24 2020 01:00:04 GMT+0330 (Iran Standard Time)
 */
class InstituteBoardMemberRepository extends Repository implements IInstituteBoardMemberRepository
{
    /**
     * The model being queried.
     *
     * @var InstituteBoardMember
     */
    public $model;

    public function __construct(InstituteBoardMember $model)
    {
        $this->model = new $model();
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function updateAndInsert($request, $institutes)
    {

        DB::transaction(function () use ($request, $institutes) {
            $len = collect($request->board_member)->count();
            $board_member = ['name', 'position', 'introduction', 'website', 'instagram', 'telegram', 'aparat', 'linkedin'];
            for ($i = 0; $i < $len; $i++) {
                if ($request->has("board_member.$i.uuid")) {
                    $data = [];
                    foreach ($board_member as $key) {
                        if ($request->has("board_member.$i.$key", null)) {
                            $data[$key] = $request->input("board_member.$i.$key");
                        }
                    }
                    if ($request->hasFile("board_member.$i.avatar")) {
                        $data['avatar'] = $request->file("board_member.$i.avatar")->store(uploadPath("institute/" . auth()->user()->uuid) . "/");
                    }
                    $this->update([
                        'institutes' => $institutes->id,
                        'uuid' => $request->input("board_member.$i.uuid")
                    ], $data);
                } else {
                    $avatar = null;
                    if ($request->hasFile("board_member.$i.avatar")) {
                        $avatar = $request->file("board_member.$i.avatar")->store(uploadPath("institute/" . auth()->user()->uuid) . "/");
                    }
                    $insert = [
                        "uuid" => uuid(),
                        'created_at' => now(),
                        'updated_at' => now(),
                        'institutes' => $institutes->id,
                        'avatar' => $avatar,
                    ];

                    foreach ($board_member as $key) {
                        if ($request->has("board_member.$i.$key", null)) {
                            $insert[$key] = $request->input("board_member.$i.$key");
                        }
                    }
                    $this->store($insert);
                }
            }

        });
    }
}
