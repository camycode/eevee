<?php
/**
 * 微信API封装
 */

class wechatApi {

	private $appid;
	private $appsecret;
	private $access_token;

	//构造函数，获取Access Token
	public function __construct() {

		$this->appid = env("WECHAT_APP_ID");
		$this->appsecret = env("WECHAT_APP_SECRET");

		// access_token 应该全局存储与更新，以下代码以写入到文件中做示例
		//$data = json_decode(file_get_contents("../access_token.json"));
		$data = connection('ximu_wechat')->table('wechat_access_token')->where('id', 1)->first();
		if ($data) {
			return 'hie';
		} else {
			return 'no';
		}

		// $data = $data->toArray();
		// if ($data["expire_time"] < time()) {

		// 	// 如果是企业号用以下URL获取access_token
		// 	//$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appid&corpsecret=$this->appsecret";
		// 	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->appsecret";
		// 	$res = json_decode($this->https_request($url), true);
		// 	$this->access_token = $res["access_token"];
		// 	if ($this->access_token) {
		// 		$expire_time = time() + 7000;
		// 		DB::table('dn_access_token')->where("id", "=", 1)->update(['access_token' => $this->access_token, 'expire_time' => $expire_time]);
		// 	}
		// } else {
		// 	$this->access_token = $data["access_token"];
		// }
	}

	// 调用客服接口创建客服会话
	public function toKefu($data) {

		$url = 'https://api.weixin.qq.com/customservice/kfsession/create?access_token=' . $this->access_token;
		$res = $this->https_request($url, $data);
		return json_decode($res, true);
	}

	//Access Token
	public function getAccessToken() {

		$AccessToken = $this->access_token;
		return $AccessToken;
	}

	//获取关注者列表
	public function get_user_list($next_openid = NULL) {

		$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=" . $this->access_token . "&next_openid=" . $next_openid;
		$res = $this->https_request($url);
		return json_decode($res, true);
	}

	//获取用户基本信息
	public function get_user_info($openid) {

		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $this->access_token . "&openid=" . $openid . "&lang=zh_CN";
		$res = $this->https_request($url);
		return json_decode($res, true);
	}

	//创建菜单
	public function create_menu($data) {

		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $this->access_token;
		$res = $this->https_request($url, $data);
		return json_decode($res, true);
	}

	//发送客服消息，已实现发送文本，其他类型可扩展
	public function send_custom_message($touser, $type, $data) {

		$msg = array('touser' => $touser);
		switch ($type) {
		case 'text':
			$msg['msgtype'] = 'text';
			$msg['text'] = array('content' => urlencode($data));
			break;
		}
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=" . $this->access_token;
		return $this->https_request($url, urldecode(json_encode($msg)));
	}

	//生成参数二维码
	public function create_qrcode($scene_type, $scene_id) {

		switch ($scene_type) {
		case 'QR_LIMIT_SCENE':

			//永久
			$data = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": ' . $scene_id . '}}}';
			break;

		case 'QR_SCENE':

			//临时
			$data = '{"expire_seconds": 1800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": ' . $scene_id . '}}}';
			break;
		}
		$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=" . $this->access_token;
		$res = $this->https_request($url, $data);
		$result = json_decode($res, true);
		return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . urlencode($result["ticket"]);
	}

	//创建分组
	public function create_group($name) {

		$data = '{"group": {"name": "' . $name . '"}}';
		$url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token=" . $this->access_token;
		$res = $this->https_request($url, $data);
		return json_decode($res, true);
	}

	//移动用户分组
	public function update_group($openid, $to_groupid) {

		$data = '{"openid":"' . $openid . '","to_groupid":' . $to_groupid . '}';
		$url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=" . $this->access_token;
		$res = $this->https_request($url, $data);
		return json_decode($res, true);
	}

	//上传多媒体文件
	public function upload_media($type, $file) {

		$data = array("media" => "@" . dirname(__FILE__) . '\\' . $file);
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=" . $this->access_token . "&type=" . $type;
		$res = $this->https_request($url, $data);
		return json_decode($res, true);
	}

	//微信signpackage
	public function getSignPackage($url) {

		$jsapiTicket = $this->getJsApiTicket();

		// 注意 URL 一定要动态获取，不能 hardcode.
		//$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		//$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		//$url = 'http://new.denong.com/#/invite';

		$timestamp = time();
		$nonceStr = $this->createNonceStr();

		// 这里参数的顺序要按照 key 值 ASCII 码升序排序
		$string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

		$signature = sha1($string);

		$signPackage = array("appId" => $this->appid, "nonceStr" => $nonceStr, "timestamp" => $timestamp, "url" => $url, "signature" => $signature, "rawString" => $string);
		return $signPackage;
	}

	private function createNonceStr($length = 16) {

		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	public function getJsApiTicket() {

		// jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
		$data = DB::table('dn_jsapi_ticket')->find(1);
		if ($data->expire_time < time()) {

			// 如果是企业号用以下 URL 获取 ticket
			//$url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$this->access_token";
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=" . $this->access_token;
			$res = json_decode($this->https_request($url));
			// print_r($res);die('ticket');
			$ticket = $res->ticket;
			if ($ticket) {
				$DBdata["expire_time"] = time() + 7000;
				$DBdata["jsapi_ticket"] = $ticket;
				DB::table('dn_jsapi_ticket')->where('id', '=', 1)->update($DBdata);
			}
		} else {
			$ticket = $data->jsapi_ticket;
		}

		return $ticket;
	}

	//https请求（支持GET和POST）
	protected function https_request($url, $data = null) {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
}
?>