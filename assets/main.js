class SocialLink {
  constructor(element, socialNetwork) {
    this.element = element;
    this.socialNetwork = socialNetwork;
    this.title = encodeURIComponent(document.title);
    this.url = encodeURIComponent(window.location.href);
  
    this.setHref();
    this.element.addEventListener('click', this.clickHandler.bind(this));
  }

  setHref() {
    this.element.setAttribute('href', this.getSharingUrl(this.socialNetwork))
  }

  getSharingUrl(socialNetwork) {
    switch (socialNetwork) {
      case 'facebook':
        return `https://www.facebook.com/sharer.php?u=${this.url}`;
      case 'twitter':
        return `https://twitter.com/share?url=${this.url}&text=${this.title}`;
      case 'linkedin':
        return `https://www.linkedin.com/shareArticle?mini=true&url=${this.url}&title=${this.title}`;
    }
  }

  clickHandler(event) {
    event.preventDefault();
    this.openWindow(event.currentTarget.href);
  }

  openWindow(url, title = 'Share Post', width = 600, height = 500) {
    const top = (window.innerHeight - height) / 2;
    const left = (window.innerWidth - width) / 2;
    const options = `status=1,width=${width},height=${height},top=${top},left=${left}`;
    window.open(url, title, options);
  }
}

const initSocialLinks = () => {
  const links = Array.from(document.querySelectorAll('.js-social'));
  links.forEach(link => new SocialLink(link, link.getAttribute('data-network')));
};

window.addEventListener('DOMContentLoaded', initSocialLinks);
