document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#search-form');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const url = new URL("index.php?action=searchMedia");
        const title = document.querySelector('#search').value

        url.searchParams.append('title', title);

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
    );

    //     fetch(url, {
    //         method: 'GET',
    //         body: formData
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         // Clear the media list
    //         const mediaList = document.querySelector('.media-list');
    //         mediaList.innerHTML = '';

    //         // Add new media items to the list
    //         data.forEach(media => {
    //             const item = document.createElement('a');
    //             item.className = 'item';
    //             item.href = `index.php?action=media&id=${media.id}`;

    //             const video = document.createElement('div');
    //             video.className = 'video';

    //             const iframe = document.createElement('iframe');
    //             iframe.allowFullscreen = true;
    //             iframe.frameBorder = 0;
    //             iframe.src = media.trailer_url;

    //             video.appendChild(iframe);
    //             item.appendChild(video);

    //             const title = document.createElement('div');
    //             title.className = 'title';
    //             title.textContent = media.title;

    //             item.appendChild(title);
    //             mediaList.appendChild(item);
    //         });
    //     })
    //     .catch((error) => {
    //         console.error('Error:', error);
    //     });
    // });
});