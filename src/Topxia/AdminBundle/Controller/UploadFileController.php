<?php
namespace Topxia\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class UploadFileController extends BaseController
{
	public function headLeaderParamsAction(Request $request)
    {
        $user = $this->getCurrentUser();
        if (!$user->isLogin()) {
            throw $this->createAccessDeniedException();
        }

        $params = $request->query->all();

        $params['user'] = $user->id;
        $params['convertCallback'] = $this->generateUrl('uploadfile_cloud_head_leader_convert_callback', array(), true);
        $params['key'] = "headLeader";
        $params['convertor'] = "HLSEncryptedVideo";
        $params['videoQuality'] = "low";
        $params['audioQuality'] = "low";
        
        $params = $this->getUploadFileService()->makeUploadParams($params);

        return $this->createJsonResponse($params);
    }

	protected function getSettingService()
    {
        return $this->getServiceKernel()->createService('System.SettingService');
    }

    protected function getUploadFileService()
    {
        return $this->getServiceKernel()->createService('File.UploadFileService');
    }
}