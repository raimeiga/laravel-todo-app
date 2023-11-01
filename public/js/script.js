// add_tag.blade.phpにおけるタグの追加モーダルの中の編集ボタンと削除ボタンを押したときのイベントを書いてるファイル
// このファイルをapp.blade.phpから読み込む

// タグの編集用フォーム
const editTagForm = document.forms.editTagForm;
 
// タグの削除用フォーム
const deleteTagForm = document.forms.deleteTagForm;

// 削除の確認メッセージ
const deleteMessage = document.getElementById('deleteTagModalLabel');

// タグの編集用モーダルを開くときの処理　
// つまりadd_tag.blade.phpにおけるタグの追加モーダルの中の編集ボタン（こっちはタグ自体）を押したときのイベント処理
document.getElementById('editTagModal').addEventListener('show.bs.modal', (event) => {
  let tagButton = event.relatedTarget;
  let tagId = tagButton.dataset.tagId;
  let tagName = tagButton.dataset.tagName;

  editTagForm.action = `tags/${tagId}`;
  editTagForm.name.value = tagName;
});

// タグの削除用モーダルを開くときの処理　
// つまりadd_tag.blade.phpにおけるタグの追加モーダルの中の削除ボタン（×マーク）を押したときのイベント処理
document.getElementById('deleteTagModal').addEventListener('show.bs.modal', (event) => {
  let deleteButton = event.relatedTarget;
  let tagId = deleteButton.dataset.tagId;
  let tagName = deleteButton.dataset.tagName;

  deleteTagForm.action = `tags/${tagId}`;
  deleteMessage.textContent = `「${tagName}」を削除してもよろしいですか？`
});