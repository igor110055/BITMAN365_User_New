function izitoast(title,message,icon,bgcolor,url){
    iziToast.show({
        title: title,
        message: message,
        icon: icon,
        backgroundColor: 'rgba(5, 7, 9, 0.6)',
        titleColor: '#FFFFFF',
        iconColor: bgcolor,
        messageColor: '#FFFFFF',
        transitionIn: 'fadeInUp',
        position: 'bottomRight',
        progressBar: true,
        progressBarColor: bgcolor,
        progressBarEasing: 'linear',
        timeout: 2000,
        onClosing: function(){
            location.href=url
        }
    });
}