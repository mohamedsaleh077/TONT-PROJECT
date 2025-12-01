
            // Tab functionality for stream info
            const infoTabs = document.querySelectorAll('.info-tab');
            const tabContents = document.querySelectorAll('.tab-content');

            infoTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');
                    
                    // Remove active class from all tabs and contents
                    infoTabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to current tab and content
                    this.classList.add('active');
                    document.getElementById(targetTab).classList.add('active');
                });
            });

            // Simulate chat messages
            const chatMessages = document.querySelector('.chat-messages');
            const chatInput = document.querySelector('.chat-input input');
            const chatButton = document.querySelector('.chat-input button');

            chatButton.addEventListener('click', function() {
                if (chatInput.value.trim() !== '') {
                    const newMessage = document.createElement('div');
                    newMessage.className = 'message';
                    newMessage.innerHTML = `
                        <img src="https://via.placeholder.com/40" alt="User" class="user-avatar">
                        <div class="message-content">
                            <span class="username">أنت:</span>
                            <span class="message-text">${chatInput.value}</span>
                        </div>
                    `;
                    chatMessages.appendChild(newMessage);
                    chatInput.value = '';
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            });

            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    chatButton.click();
                }
            });

            // Simulate live viewer count updates
            function updateViewerCount() {
                const viewerCount = document.querySelector('.viewer-count');
                const current = parseInt(viewerCount.textContent.replace(/\D/g, ''));
                const change = Math.floor(Math.random() * 10) - 3; // Random change between -3 and +6
                const newCount = Math.max(10000, current + change);
                viewerCount.innerHTML = `<i class="fas fa-eye"></i> ${newCount.toLocaleString()} مشاهد`;
            }

            // Update viewer count every 15 seconds
            setInterval(updateViewerCount, 15000);
        