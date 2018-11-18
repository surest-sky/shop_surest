@extends('admin.common.layout')
@section('body')
    
    <body>
        <div class="x-body">
            <form action="{{ route('admin.admins.role.store') }}" method="post" class="layui-form layui-form-pane">

                <div class="layui-form-item">
                    @if($status = session('status') )
                        <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $status }}</button>
                    @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $error }}</button>
                    @endforeach
                @endif
                </div>
                <div class="layui-form-item">
                    {{ csrf_field() }}

                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>角色名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" required="" lay-verify="required" value="{{ $role->name ?? ''}}" autocomplete="off" class="layui-input">
                        <input type="hidden" name="id" value="{{ $role->id ?? ''}}">

                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        拥有权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="layui-input-block">
                                        @if( isset($role) )
                                            @foreach($permissions as $permission)
                                                <input name="ids[]" @if(in_array($permission->id,$ids)) checked @endif type="checkbox" value="{{ $permission->id }}"> {{ $permission->name }}
                                            @endforeach
                                        @else
                                            @foreach($permissions as $permission)
                                                <input name="ids[]" type="checkbox" value="{{ $permission->id }}"> {{ $permission->name }}
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        描述
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="desc" name="description" class="layui-textarea">{{ $role->description ?? '' }}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="save">保存</button>
              </div>
            </form>
        </div>
    </body>
        @stop

        @section('script')
            <script>
                layui.use(['form','layer'], function(){
                    $ = layui.jquery;
                    var form = layui.form()
                        ,layer = layui.layer;
                });
            </script>
        @stop