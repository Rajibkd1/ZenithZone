function toggleFullscreenImage() {
    const fullscreenContainer = document.getElementById('fullscreenContainer');
    const fullscreenImage = document.getElementById('fullscreenImage');
    const artImage = document.getElementById('artImage');
    const cardContainer = document.getElementById('cardContainer');
    if (fullscreenContainer.style.display === 'none') {
      fullscreenImage.src = artImage.src;
      fullscreenContainer.style.display = 'flex';
      cardContainer.style.display = 'none';
    } else {
      fullscreenContainer.style.display = 'none';
      cardContainer.style.display = 'block';
    }
  }
  function showModal(title, message) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('messageModal').classList.remove('hidden');
  }
  function hideModal() {
    document.getElementById('messageModal').classList.add('hidden');
  }
  document.getElementById('toggleButton').addEventListener('click', function() {
    var biddersList = document.getElementById('biddersList');
    var button = document.getElementById('toggleButton');
    if (biddersList.classList.contains('hidden')) {
      biddersList.classList.remove('hidden');
      button.textContent = 'Hide Bidder List';
    } else {
      biddersList.classList.add('hidden');
      button.textContent = 'Show Bidder List';
    }
  });