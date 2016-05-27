<?php 

namespace Core\Models\Product;

use Core\Models\Model;
use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class Product {

    // 初始化Product记录
    protected static function initializeProduct(array $data){

        $initialized = [
            'id' => Model::id(),
            'type' => '',
            'status' => '',
        ];

        Model::timestamps($initialized, true);

        return array_merge($initialized, $data);
    }

    // Product数据校验
    protected static function validateProduct(array $data, array $ignore = []){

        $table = Model::table('product');

        // 数据验证规则: http://doc.eevee.io/validation.html

        $rule = [

        ];

        Model::ignore($data,$ignore);

        $validator = Validator::make($data, $rule);

        if($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    // 获取Product
    protected static function getProduct($product_id){

        if($data = Model::resource('product')->where($product_id)->first()){

            Permission::guard((array)$data, true);

            return status('success',$data);
        }

        exception('productDoesNotExist');
    }

    // 获取Product组
    protected static function getProducts(array $params){

        $data = Model::selector('$product', $params);

        Permission::guard($data, true);

        return status('success', $data);
    }

    // 添加Product记录
    protected static function addProduct(array $data){

        Permission::guard($data);

        self::validateProduct($data);

        $data = self::initializeProduct($data);

        return Model::transaction(function() use($data){

            Model::filter($data, Model::fields('product'));

            Model::resource('product')->insert($data);

            $status = self::getProduct($data['id']);

            return $status;

        });

    }

    // 更新Product记录
    protected static function updateProduct($product_id, array $data){

        Permission::guard($data);

        $origin = self::getProduct($product_id)->data;

        $ignore = [

        ];

        self::validateProduct($data, $ignore);

        return Model::transaction(function() use($data){

            Model::filter($data, Model::fields('product'));

            Model::resource('product')->where('product_id')->update($data);

            $status = self::getProduct($data['id']);

            return $status;

        });

    }

    // 删除Product记录
    protected static function deleteProduct($product_id){

        $origin = self::getProduct($product_id)->data;

        Permission::guard((array)$origin, true);

        Model::resource('product')->where('product_id')->delete();

        return status('success');
    }
}

