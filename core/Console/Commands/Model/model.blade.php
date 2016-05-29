{!! $StartTag !!}

namespace Core\Models{{ $ModelNamespacePath }};

use Core\Models\Model;
use Illuminate\Support\Facades\Validator;

class {{  $ModelName }} extends Model
{

    protected $fields = ['id','created_at','updated_at'];

    // 初始化{{ $ModelName }}记录
    protected function initialize{{ $ModelName }}()
    {

        $initialized = [
            'id' => $this->id(),
        ];

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);
    }

    // {{ $ModelName }}数据校验
    protected function validate{{ $ModelName }}(array $ignore = [])
    {

        $tableName = $this->tableName();

        $rule = [

        ];

        $this->ignore($this->data,$ignore);

        $validator = Validator::make($this->data, $rule);

        if($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    // 获取{{ $ModelName }}
    protected function get{{ $ModelName }}(${{ $ModelNameToLower }}_id)
    {

        if($data = $this->table()->where('{{ $ModelNameToLower }}_id',${{ $ModelNameToLower }}_id)->first()){

            $this->guard($data, 'get', GUARD_GET);

            return status('success',$data);
        }

        exception('{{ $ModelNameToLower }}DoesNotExist');
    }

    // 获取{{ $ModelName }}组
    protected function get{{ $ModelName }}s(array $params)
    {

        $data = $this->selector($params);

        $this->guard($data, 'get', GUARD_GET);

        return status('success', $data);
    }

    // 添加{{ $ModelName }}记录
    protected function add{{ $ModelName }}()
    {

        $this->guard($this->data, 'add', GUARD_ADD);

        $this->validate{{ $ModelName }}();

        $this->initialize{{ $ModelName }}();

        return $this->transaction(function(){

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            $status = $this->get{{ $ModelName }}($this->data['id']);

            return $status;

        });

    }

    // 更新{{ $ModelName }}记录
    protected function update{{ $ModelName }}(${{ $ModelNameToLower }}_id)
    {
        $origin = $this->get{{ $ModelName }}(${{ $ModelNameToLower }}_id)->data;

        $this->guard($origin, 'update', GUARD_UPDATE);

        $ignore = [

        ];

        $this->validate{{ $ModelName }}($ignore);

        return $this->transaction(function() use(${{ $ModelNameToLower }}_id){

            $this->filter($this->data, $this->fields);

            $this->table()->where('{{ $ModelNameToLower }}_id','{{ $ModelNameToLower }}_id')->update($this->data);

            $status = $this->get{{ $ModelName }}($this->data['id']);

            return $status;

        });

    }

    // 删除{{ $ModelName }}记录
    protected function delete{{ $ModelName }}(${{ $ModelNameToLower }}_id)
    {

        $origin = $this->get{{ $ModelName }}(${{ $ModelNameToLower }}_id)->data;

        $this->guard($origin, 'delete', GUARD_DELETE);

        $this->table()->where('{{ $ModelNameToLower }}_id')->delete();

        return status('success');
    }
}

