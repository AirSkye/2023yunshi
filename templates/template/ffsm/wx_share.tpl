<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script>
    wx.config({
        debug: false,
        appId: '<{$signPackage.appId}>',
        timestamp: '<{$signPackage.timestamp}>',
        nonceStr: '<{$signPackage.nonceStr}>',
        signature: '<{$signPackage.signature}>',
        jsApiList: [
        // 所有要调用的 API 都要加到这个列表中
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
			'updateAppMessageShareData',
			'updateTimelineShareData'
        ]
    });
    wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
        wx.onMenuShareAppMessage({
         title: '<{$sh_title}>', // 分享标题
         desc: '<{$sh_desc}>', // 分享描述
         link: '<{$sh_url}>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
         imgUrl: '<{$sh_img}>', // 分享图标
         type: '',  // 分享类型,music、video或link，不填默认为link
         dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
         success: function () {   
        // 用户确认分享后执行的回调函数
        },
      });
    });
</script>