// add_tag.blade.phpにおけるタグの追加モーダルの中の編集ボタンと削除ボタンを押したときのイベントを書いてるファイル
// このファイルをapp.blade.phpから読み込む

// タグの編集用フォーム
const editTagForm = document.forms.editTagForm;
/* editTagFormという定数名をつけ、edit_tag.blade.php（タグの編集用モーダルのファイル）から
 editTagFormというname属性を持つフォームを取得してる
*/

// タグの削除用フォーム
const deleteTagForm = document.forms.deleteTagForm;
/* deleteTagFormという定数名をつけ、delete_tag.blade.php（タグの編集用モーダルのファイル）から
   deleteTagFormというname属性を持つフォームを取得してる
*/

// 削除の確認メッセージ
const deleteMessage = document.getElementById('deleteTagModalLabel');

/* ↓ タグの編集用モーダルを開くときの処理。つまりタグの追加用モーダル（add_tag.blade.php）を
     開くと表示されるモーダル上の編集ボタン（こっちはタグ自体）を押したときのイベント処理  */
document.getElementById('editTagModal').addEventListener('show.bs.modal', (event) => {

  // ↓ relatedTargetプロパティ=イベントに関連する別の要素（今回の場合は「モーダルを開くときにクリックされたボタン」）を取得できるらしい
  let tagButton = event.relatedTarget;  

  /*datasetプロパティ=data-tag-id属性やdata-tag-name属性のようなカスタムデータ属性を取得
    今回はadd_tag.blade.php（追加用モーダル）上でクリックしたタグのdata-tag-id、data-tag-nameを取得している*/
  let tagId = tagButton.dataset.tagId;      
  let tagName = tagButton.dataset.tagName;  

  editTagForm.action = `tags/${tagId}`; // ↑で取得したタグのidを呼び出し
  editTagForm.name.value = tagName;     // ↑で取得したタグのnameを呼び出し
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