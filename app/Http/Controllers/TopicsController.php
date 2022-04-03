<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;
class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    //加入Topic $topic在里面使用$topic->.... 否则是Topic::...
	public function index(Request $request, Topic $topic)
	{
	    //在index视图里遍历了topics，并且因为topics关联了user和category,所以提前用with()进行缓冲可大大减少查询时间,防止N+1问题。
	    //遇到关联表的遍历记得用with缓冲
	  
		$topics = $topic->withOrder($request->order) //传递给withOrder order(排序顺序)来决定排序顺序
		->with('user','category')->paginate(20);
	
		return view('topics.index', compact('topics'));
	}

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
    {
        //这里是选择所有的种类传给视图。在视图中引用达到下拉菜单效果
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }
	

	public function store(TopicRequest $request,Topic $topic)
	{
	    //创建一个空的topic，然后向里面插入数据
	    
	    //fill会自动将键值赋给topic（$request->all()是数组）
		$topic->fill($request->all());
	    $topic->user_id=Auth::user()->id;
	    $topic->save();
		return redirect()->route('topics.show', $topic->id)->with('message', 'Created successfully.');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}
	
//发布和编辑帖子

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}