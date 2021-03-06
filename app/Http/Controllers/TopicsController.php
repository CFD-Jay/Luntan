<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;
use App\Handlers\ImageUploadHandler;
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

    //
    public function show(Request $request, Topic $topic)
    {
        // URL 矫正
        //因为现在显示帖子的路由带有slug，所以注入Request来获取路由中的slug
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);            //永久重定向到正确的路由上
        }

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
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
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




    //贴子上传图片
    public function uploadImage(Request $request,ImageUploadHandler $uploader)
    {
        //这么引用是错误的，要写在形参里
        //ImageUploadHandler $uploader;
        
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
           
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        
        //返回数组会自动转化为json数据给create_and_edit中
        return $data;
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}