async function sendMessage() {
  const input = document.getElementById('user-input');
  const message = input.value.trim();
  if (!message) return;

  addMessage(message, 'user-msg');
  input.value = '';

  try {
    const response = await fetch('chatbot.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ message })
    });

    if (!response.ok) {
      const error = await response.text();
      console.error('Server error:', error);
      addMessage('Ups! Gagal mengambil balasan dari bot.', 'bot-msg');
      return;
    }

    const data = await response.json();
    addMessage(data.reply, 'bot-msg');
  } catch (err) {
    console.error(err);
    addMessage('Terjadi kesalahan jaringan.', 'bot-msg');
  }
}

// Fungsi untuk mengonversi format Markdown dasar ke HTML
function convertMarkdownToHTML(text) {
  return text
    .replace(/^#{1,6}\s*(.*)$/gm, '<h3>$1</h3>')   // Ganti # header jadi <h3>
    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')   // Tebal: **teks**
    .replace(/\*(.*?)\*/g, '<em>$1</em>')               // Miring: *teks*
    .replace(/(?:\r\n|\r|\n)/g, '<br>');                // Ganti baris jadi <br>
}

// Fungsi untuk menambahkan pesan ke chat box
function addMessage(text, className) {
  const box = document.getElementById('chat-box');
  const div = document.createElement('div');
  div.className = `bubble ${className}`;
  const htmlContent = convertMarkdownToHTML(text);
  div.innerHTML = `<b>${className === 'user-msg' ? 'Anda' : 'Bot'}:</b> ${htmlContent}`;
  box.appendChild(div);
  box.scrollTop = box.scrollHeight;
}

// Tambahkan event listener Enter key untuk mengirim pesan
const userInput = document.getElementById('user-input');
userInput.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    event.preventDefault();
    sendMessage();
  }
});
