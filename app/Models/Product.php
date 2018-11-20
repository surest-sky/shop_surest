<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Traits\ProductCacheTrait;

class Product extends Model
{

    use ProductCacheTrait;

    public $guarded = [];

    const total = 10;

    const type = 'DESC';

    const key = 'product_list';

    /**
     * 获取所有的商品数据
     * @param bool $page true = 分页数据获取 false = 获取全部数据
     * @return Product[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection|mixed|string|void
     */
    public static function getProductsAll($page=true)
    {
        if( $page ) {
            $products = self::getPageProduct();
        }else{
            $products = self::getAllProduct();
        }
        return $products;
    }

    /**
     * 后台管理模块
     * 分页数据获取商品数据
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getPageProduct()
    {
        $products = self::with(['productSkus','category','comments.user'])->orderBy('created_at',self::type)
                    ->paginate(self::total);

        return $products;
    }

    /**
     * 从缓存中获取所有的商品
     * @return Product[]|Collection|mixed|string|void
     */
    public static function getAllProduct()
    {
        $products = self::getCacheProduct();
        return $products;
    }

    public static function getSimpleProductOrComment($pid)
    {
        $product = self::with('comments')->where('id',$pid)->first();
        return $product;
    }
    /**
     * 关联图片
     * 一对一
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class,'product_id','id')->select('id','src','product_id');
    }

    /**
     * 关联分类
     * 多对一
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id')->select('id','name');
    }

    /**
     * 关联sku
     * 一对多
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSkus()
    {
        return $this->hasMany(ProductSku::class,'product_id','id');
    }

    /**
     * 关联评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id','id');
    }

    /**
     * 推荐的列表
     * 算法：
     * 分类优先
     * 销量优先
     * 评论优先
     * 价格优先
     */
    public static function getGoodsProductOnCategory($cid,$pid)
    {
        $products = self::getCacheProduct();

        $products = $products->where('category_id',$cid)->whereNotIn('id',$pid)->sortByDesc('sold_count')->take(10);

        $products->shuffle();

        return $products;
    }
    /**
     * 修改器
     * @return int
     */
    public function getStockAttribute()
    {
        $stock = 0;
        foreach ($this->productSkus as $sku){
            $stock += $sku->stock;
        }
        return $stock;
    }

    public function getRatingXingAttribute()
    {
        $value = $this->rating;
        $value= max(1,sprintf('%d',$value));
        return str_repeat('⭐',$value);
    }

    public function getSku1Attribute()
    {
        return $this->productSkus->first();
    }

    public function getSku2Attribute()
    {
        return $this->productSkus->last();
    }

    public function getProductImgAttribute()
    {
        return $this->image->src;
    }

    public function getStrPriceAttribute()
    {
        return '￥' . $this->price;
    }

    /**
     * 数据排序
     * @param $products
     * @param $sort
     * @return mixed
     */
    public function productSort($products,$sort)
    {
        switch ($sort){
            case 'sale':
                return $products->sortByDesc('sold_count');
                break;
            case 'review':
                return $products->sortByDesc('review_count');
                break;
            case 'h_price':
                return $products->sortByDesc('price');
                break;
            case 'b_price':
                return $products->sortBy('price');
                break;
            default:
                return $products->sortByDesc('created_at');
                break;
        }
    }

    // 分类数据组装
    public function productPage($products,$currentPage)
    {
        $pageSize = 6;  #每页多少数据
        $total = $products->count(); # 总数量
        $endPage = (int)ceil($total/$pageSize);
        $nextPage = (int)$currentPage+1;
        $prevPage = (int)$currentPage-1;


        if( $currentPage >= $endPage ){
            $currentPage = $endPage;
            $nextPage = $endPage;
        }
        if( $currentPage <= 1 ){
            $currentPage = 1;
            $prevPage = 1;
        }

        # 从当前页*5取出指定条数
        $products = $products->slice(($currentPage-1)*$pageSize);
        $products = $products->take($pageSize);

        return [
            'products' => $products,
            'next' => $nextPage,
            'prev' => (int)$prevPage,
            'endPage' => $endPage,
            'current' => $currentPage
        ];
    }

    /**
     * 获取商品的最近信息 （5条）
     */
    public static function getSubscription($len=5)
    {
        $products = self::query()->orderBy('created_at','DESC')->limit(5)->get();
        return $products;
    }
}
