<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\WeightLogRequest;
use App\Http\Requests\UpdateGoalSettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        $query = WeightLog::where('user_id', Auth::id());

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8)->appends($request->query());

        $latestWeight = WeightLog::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->value('weight');

        $targetWeight = WeightTarget::where('user_id', Auth::id())->value('target_weight');

        $diff = ($latestWeight && $targetWeight) ? $targetWeight - $latestWeight : null;

        // 検索メッセージ用
        $searchMessage = null;
        if ($startDate && $endDate) {
            $count = $logs->total(); // ページネーション全体の件数
            $searchMessage = "{$startDate}〜{$endDate}の検索結果 {$count}件";
        }

        return view('weight_logs.index', compact(
            'logs',
            'latestWeight',
            'targetWeight',
            'diff',
            'searchMessage',
        ));
    }

    // 登録処理
    public function store(WeightLogRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        WeightLog::create($data);

        return redirect()->route('weight_logs.index')->with('message', 'データを登録しました');
    }

    // 詳細表示
    public function show($id)
    {
        $log = WeightLog::where('user_id', Auth::id())->findOrFail($id);
        return view('weight_logs.detail', compact('log'));
    }

    // 更新処理
    public function update(WeightLogRequest $request, $id)
    {
        $log = WeightLog::where('user_id', Auth::id())->findOrFail($id);
        $log->update($request->validated());

        return redirect()->route('weight_logs.index')->with('message', 'データを更新しました');
    }

    // 削除処理
    public function destroy($id)
    {
        $log = WeightLog::where('user_id', Auth::id())->findOrFail($id);
        $log->delete();

        return redirect()->route('weight_logs.index')->with('message', 'データを削除しました');
    }

    public function showGoalSetting()
    {
        // レコードが無ければ user_id だけで作成（target_weight は null）
        $target = WeightTarget::firstOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => null]
        );

        return view('weight_logs.goal_setting', compact('target'));
    }

    public function updateGoalSetting(UpdateGoalSettingRequest $request)
    {
        $validated = $request->validated();

        $target = WeightTarget::firstOrCreate(['user_id' => Auth::id()]);
        $target->update(['target_weight' => $validated['target_weight']]);

        return redirect()
            ->route('weight_logs.index')
            ->with('message', '目標体重を更新しました');
    }
}
