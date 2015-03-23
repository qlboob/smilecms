<?php
namespace Pt\Controller;
use Think\Controller;
/**
 * 定时任务
 * @author lukeqin
 *
 */
class CronController extends Controller {
	
	/**
	 * 下载微信上传的图片
	 */
	function downLoad() {
		$model = D('Wximg');
		$picModel = D('Infopic');
		$lists = $model->where('wxi_retry<5')->select();
		$mimeMap = array(
			'image/jpeg'=>'jpg',
			'image/jpg'=>'jpg',
			'image/png'=>'png',
			'image/bmp'=>'bmp',
		);
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		if($lists){
			foreach ($lists as $v){
				$content = $wx->getMedia($v['wxi_imgid']);
				if ($content) {
					$ext = $mimeMap[$wx->lastHttpStatus[CURLINFO_CONTENT_TYPE]];
					$filename = uniqid('wximg_').'.'.$ext;
					$filePath = THINK_PATH.'../upload/img/'.$filename;
					file_put_contents($filePath, $content);
					$picModel->add(array(
						'ifp_path'=>$filename,
						'ifm_id'=>$v['ifm_id'],
					));
					$model->delete($v['wxi_imgid']);
				}else {
					++$v['wxi_retry'];
					$model->save($v);
				}
			}
		}
	}
}