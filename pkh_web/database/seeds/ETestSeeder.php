<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\TrnEtest;
use App\Models\TrnEtestAssign;
use App\Models\TrnEtestResult;
use App\Models\TrnEtestSentence;

class ETestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('ETestSeeder');

        // 1: PKH
		// 2: SẢN PHẨM CỦA PKH
		// 3: ĐIỀU KIỆN MUA HÀNG/ TRỞ THÀNH ĐẠI LÝ PHÂN PHỐI
		// 4: THỦ TỤC ĐỂ TRỞ THÀNH ĐẠI LÝ PHÂN PHỐI
		// 5: THỦ TỤC MUA HÀNG
		// 6: THANH TOÁN
		// 7: BẢO HÀNH
		// 8: SALES
		// 9: PURCHASING
		// 10: ACCOUNTANT
		// 11: WAREHOUSE
		// 12: MARKETING
		// 13: IT

        // Sales Admin
        $this->createTest1(1, "Bài kiểm tra tháng 2/2017 (CS)", [2, 4], [1,2,3,4,5,6,7,9,12]);
        // Sales
        $this->createTest1(2, "Bài kiểm tra tháng 2/2017 (Nhân viên kinh doanh)", [3, 6, 7, 9], [1,2,3,4,5,6,7,8,14,15]);
        // Accountant
        $this->createTest1(3, "Bài kiểm tra tháng 2/2017 (Kế toán)", [8], [1,2,3,4,5,6,7,10]);
        // Warehourse
        $this->createTest1(4, "Bài kiểm tra tháng 2/2017 (Nhân viên kho)", [9], [1,2,3,4,5,6,7,11]);
        // IT
        $this->createTest1(5, "Bài kiểm tra tháng 2/2017 (IT)", [1, 5], [1,2,3,4,5,6,7,13]);
    }

    /**
     * Test 2/2017
     * @return [type] [description]
     */
    public function createTest1($etest_id, $title, $userIds, $group) {

    	// $etest_id = 1;
    	// $userIds = [1,2,3,4,5,6,7,8];

    	TrnEtest::where('id', $etest_id)->delete();
    	TrnEtestAssign::where('etest_id', $etest_id)->delete();
    	TrnEtestSentence::where('etest_id', $etest_id)->delete();

    	// Create eTest
    	$eTest = new TrnEtest();
    	$eTest->id = $etest_id;
    	// $eTest->title = "Bài kiểm tra tháng 2/2017";
    	$eTest->title = $title;
    	$eTest->test_min = 60;
    	$this->updateRecordHeader($eTest);
    	$eTest->save();

    	// Create Assign
    	foreach ($userIds as $uid) {
    		$assign = new TrnEtestAssign();
    		$assign->etest_id = $etest_id;
    		$assign->user_id = $uid;
    		$assign->from_date = Carbon::create(2017, 2, 1);
    		$assign->to_date = Carbon::create(2017, 2, 28);
    		$assign->mark = 0;
    		$this->updateRecordHeader($assign);
    		$assign->save();
    	}

    	// Create Sentence
    	$sentences = $this->getSentences($group);

		$seq_no = 1;
		foreach ($sentences as $group) {
			$entity = new TrnEtestSentence();
			$entity->etest_id = $etest_id;
			$entity->seq_no = $seq_no++;
			// seq_type
            // 0: group
            // 1: text
            // 2: textarea
            // 3: checkbox
            // 4: radio
            $entity->seq_type = '0';
            $entity->question = $group["name"];
            $this->updateRecordHeader($entity);
            $entity->save();

            foreach ($group["items"] as $sentence) {
            	$entity = new TrnEtestSentence();
				$entity->etest_id = $etest_id;
				$entity->seq_no = $seq_no++;
	            $entity->seq_type = '2';		// textarea
	            $entity->question = $sentence["text"];
	            $this->updateRecordHeader($entity);
	            $entity->save();
            }
		}
    }

    private function updateRecordHeader($entity) {
    	$entity->active_flg = '1';
    	$entity->created_at = Carbon::now();
    	$entity->created_by = 1;
    	$entity->updated_at = Carbon::now();
    	$entity->updated_by = 1;
    	$entity->version_no = 0;
    }

    private function getSentences($names = null) {
    	$sentences = [
				[ 
					'no'   => 1,
					'name' => 'PKH',
					'items' => [
						['no' => '1', 'text' => 'Tên đầy đủ của PKH bằng tiếng Việt và tiếng Anh.'],
						['no' => '2', 'text' => 'Địa chỉ (đăng ký & kinh doanh), số điện thoại (bàn & hotline), fax của PKH'],
						['no' => '3', 'text' => 'Có thể  liên hệ với PKH ở đâu? Tôi thấy ở một số cửa hàng/trên báo đăng có thông tin của PKH, tôi muốn mua hàng thì như thế nào?'],
						['no' => '4', 'text' => 'Nếu tôi ở tỉnh , tôi có thể liên hệ với ai để mua hàng chính hãng?'],
						['no' => '5', 'text' => 'Nếu tôi có thắc mắc, hay ý kiến gì với PKH, tôi phải liên hệ với ai và bằng cách nào?']
					]
				],
				[ 
					'no'   => 2,
					'name' => 'SẢN PHẨM CỦA PKH',
					'items' => [
						['no' => '1', 'text' => 'PKH đang bán các sản phẩm gì? Tôi thấy thông tin của PKH trên báo và website nhưng không đầy đủ, có những lựa chọn nào phụ hợp cho tôi?'],
						['no' => '2', 'text' => 'Tôi thấy không an tâm lắm với các sản phẩm từ nhựa, đặc biệt là liên quan đến sinh hoạt hàng ngày của gia đình tôi?'],
						['no' => '3', 'text' => 'Tôi thấy không an tâm về độ bền của các sản phẩm từ nhựa? '],
						['no' => '4', 'text' => 'Tôi thấy các sản phẩm từ nhựa thường thiết kế không đẹp '],
						['no' => '5', 'text' => 'Tôi chưa thấy hoặc nghe đến thương hiệu Watertec này bao giờ?'],
						['no' => '6', 'text' => 'Tôi không biết lựa chọn sản phẩm nào thích hợp giữa các sản phẩm có chất liệu từ nhựa, đồng và thau?'],
						['no' => '7', 'text' => 'Tôi thấy các sản phẩm từ nhựa không đẹp khi đưa vào lắp trong bếp hoặc nhà tắm với các sản phẩm từ đồng và thau'],
						['no' => '8', 'text' => 'Một bộ sản phẩm Watertec hiện tại của PKH đang bán gồm có những sản phẩm nào?'],
						['no' => '9', 'text' => 'Tôi thấy sản phẩm của PKH cũng không khác gì so với các sản phẩm nhựa khác trên thị trường nên tôi cũng không rõ tại sao tôi phải chọn PKH? '],
						['no' => '10', 'text' => 'Tôi có thể mua ít hơn với số lượng một bộ sản phẩm chuẩn của PKH không?'],
						['no' => '11', 'text' => 'Tôi có thể đàm phán giảm giá được không?'],
						['no' => '12', 'text' => 'Nếu tôi mua số lượng lớn, PKH có thể giảm giá không?'],
						['no' => '13', 'text' => 'Tôi có thể đổi sản phẩm sau khi đã giao hàng không?'],
						['no' => '14', 'text' => 'Tôi có thể để đặt hàng giúp người khác không?'],
						['no' => '15', 'text' => 'Nếu đột xuất không mua hàng nữa sau khi đã giao hàng và thanh toán, tôi phải làm gì? Tôi có bị mất tiền không?'],
						['no' => '16', 'text' => 'PKH có thay thế sản phẩm mới khi phát hiện sản phẩm lỗi không?'],
						['no' => '17', 'text' => 'Tôi thấy trên thị trường có các sản phẩm giống với sản phẩm Watertec của PKH đang phân phối, đấy có phải là sản phẩm chính hãng không?'],
						['no' => '18', 'text' => 'Trường hợp tôi phát hiện sản phẩm không chính hãng tôi phải làm gì?'],
						['no' => '19', 'text' => 'Trường hợp tôi phân phối hàng không chính hãng thì sẽ có ảnh hưởng gì?'],
						['no' => '20', 'text' => 'Tôi nghe là PKH có thể thu hồi sản phẩm không chính hãng, việc này có thật ko? Tôi có được bồi thường gì ko?'],
						['no' => '21', 'text' => 'Tôi có được mua hàng và thanh toán bằng ngoại tệ ko?']
					]
				],
				[ 
					'no'   => 3,
					'name' => 'ĐIỀU KIỆN MUA HÀNG/ TRỞ THÀNH ĐẠI LÝ PHÂN PHỐI',
					'items' => [
						['no' => '1', 'text' => 'Điều kiện mua hàng/ trở thành đại lý phân phối của PKH như thế nào?'],
						['no' => '2', 'text' => 'Nếu tôi cam kết doanh số đáp ứng trên mức công ty yêu cầu,tôi có được ưu đãi hơn không?'],
						['no' => '3', 'text' => 'Nếu tôi chưa có cửa hàng, tôi có thể trở thành đại lý phân phối của PKH không?'],
						['no' => '4', 'text' => 'Nếu tôi mới chuyển sang kinh doanh ở một địa bàn khác, tôi có được phân phối tiếp không? ']
					]
				],
				[ 
					'no'   => 4,
					'name' => 'THỦ TỤC ĐỂ TRỞ THÀNH ĐẠI LÝ PHÂN PHỐI',
					'items' => [
						['no' => '1', 'text' => 'Tôi cần phải chuẩn bị những thủ tục gì nếu có để trở thành đại lý phân phối chính thức của PKH?'],
						['no' => '2', 'text' => 'Nếu tôi không có giấy phép đăng ký kinh doanh,mặc dù trên thực tế tôi đang có cửa hàng kinh doanh, thì PKH có thể xem xét được không?'],
						['no' => '3', 'text' => 'Nếu tôi muốn trở thành nhà phân phối độc quyền của PKH thì cần phải chuẩn bị những thủ tục gì?'],
						['no' => '4', 'text' => 'Nếu tôi chuyển các thông tin các cửa hàng đang phân phối, thì công ty có đảm bảo không chào bán vào các cửa hàng của tôi không?'],
						['no' => '5', 'text' => 'Tôi có được quyền lợi gì khi trở thành nhà phân phối chính thức của PKH?'],
						['no' => '6', 'text' => 'Tôi có bị mất quyền phân phối của PKH không? Nếu có thì trong các trường hợp nào?'],
						['no' => '7', 'text' => 'Thông tin cá nhân của tôi và cửa hàng phân phối của tôi có bị tiết lộ không? Tôi có thể tin chắc rằng thông tin của tôi luôn được bảo mật không?']
					]
				],
				[ 
					'no'   => 5,
					'name' => 'THỦ TỤC MUA HÀNG',
					'items' => [
						['no' => '1', 'text' => 'Tôi có thể chuyển đơn hàng cho NV đại lý được không?'],
						['no' => '2', 'text' => 'Tôi có thể gọi điện đặt hàng trước rồi bổ sung đơn đặt hàng theo yêu cầu sau được không? '],
						['no' => '3', 'text' => 'Tôi có thể thực hiện việc mua hàng qua email được không? '],
						['no' => '4', 'text' => 'Khi nào thì tôi sẽ nhận được phản hồi về đặt hàng của PKH và PKH sẽ thông báo cho tôi bằng cách nào? Nếu tôi sống ở tỉnh, thời gian giao hàng của PKH là bao lâu?'],
						['no' => '5', 'text' => 'Khi đã nhận được hàng của PKH chưa ký vào phiếu giao hàng, vì một nguyên nhân nào đó mà tôi không muốn nhận nữa thì tôi có phải thông báo cho PKH không? Và nếu có thì thông báo cho ai và bằng cách nào. Lúc đó tôi có phải chịu phí gì không'],
						['no' => '6', 'text' => 'Khi đã nhận được hàng của PKH đã ký vào phiếu giao hàng, vì một nguyên nhân nào đó mà tôi không muốn nhận nữa thì tôi có phải thông báo cho PKH không? Và nếu có thì thông báo cho ai và bằng cách nào. Lúc đó tôi có phải chịu phí gì không'],
						['no' => '7', 'text' => 'Tôi có thể tới văn phòng của PKH và đề nghị xuất hóa đơn trước khi giao hàng được không?'],
						['no' => '8', 'text' => 'Tôi có thể đề nghị xuất hóa đơn với giá trị như tôi yêu cầu được không?']
					]
				],
				[ 
					'no'   => 6,
					'name' => 'THANH TOÁN',
					'items' => [
						['no' => '1', 'text' => 'Tôi có thể thanh toán ở đâu?tôi có thể trả tiền mặt tại PKH không?Thời gian làm việc như thế nào?'],
						['no' => '2', 'text' => 'Tiền tôi chuyển khoản cho PKH có được tính kể từ ngày báo nợ ở tài khoản của tôi/ngày tôi nộp tiền mặt vào ngân hàng không?'],
						['no' => '3', 'text' => 'Nộp tiền ở Eximbank hay các NH liên kết của Eximbank tôi được lợi gì?'],
						['no' => '4', 'text' => 'Những thông tin nào tôi cần ghi rõ trong "giấy chuyển tiền"?'],
						['no' => '5', 'text' => 'Tôi có thể được PKH nhắc nợ không? Nếu có bằng cách nào?'],
						['no' => '6', 'text' => 'Nếu tôi trả trễ , tôi phải chịu phạt như thế nào? Nếu vì lý do ngân hàng chuyển tiền đi chậm, tôi bị trễ 1-2 ngày, PKH có chấp nhận không?'],
						['no' => '7', 'text' => 'Tôi có được trả trước sớm 1 phần hay toàn bộ không? Nếu có thủ tục và phí như thế nào?'],
						['no' => '8', 'text' => 'Nếu tôi muốn có hóa đơn cho mỗi lần trả tiền có được không?'],
						['no' => '9', 'text' => 'Làm thế nào tôi có thể biết số dư nợ của mình trong từng thời điểm?'],
						['no' => '10', 'text' => 'Tôi có thể thay đổi ngày thanh toán không? Nếu có thì thủ tục như thế nào?'],
						['no' => '11', 'text' => 'Nếu tôi gặp khó khăn trong việc thanh toán, tôi có thể gia hạn thanh toán không? Nếu có thì thủ tục như thế nào?']
					]
				],
				[ 
					'no'   => 7,
					'name' => 'BẢO HÀNH',
					'items' => [
						['no' => '1', 'text' => 'Tôi có được bảo hành cho các sản phẩm mua ngoài thị trường thay vì mua trực tiếp công ty không?'],
						['no' => '2', 'text' => 'Tôi có được bảo hành cho các sản phẩm mua ngoài thị trường trong bao lâu?'],
						['no' => '3', 'text' => 'Các đại lý bán hàng có thực hiện bảo hành cho tôi không hay phải đến trực tiếp công ty?'],
						['no' => '4', 'text' => 'Nếu phát sinh hư hại trong quá trình lắp đặt, tôi có thể gọi PKH không?'],
						['no' => '5', 'text' => 'Tôi phát hiện sản phẩm hư hại sau khi đã thay mới, tôi phải làm gì?'],
						['no' => '6', 'text' => 'Để được bảo hành tôi cần phải chuẩn bị thủ tục gì?']
					]
				],
				[ 
					'no'   => 8,
					'name' => 'SALES',
					'items' => [
						['no' => '1', 'text' => 'Bạn vui lòng cho biết 6 ký tự đầu của mã PKH có ý nghĩa gì?'],
						['no' => '2', 'text' => 'Bạn vui lòng cho biết 8 ký tự cuối của mã PKH có ý nghĩa gì?'],
						['no' => '3', 'text' => 'Bạn vui lòng cho biết chuỗi ký tự …VHTR1 có ý nghĩa gì?'],
						['no' => '4', 'text' => 'Bạn vui lòng cho biết giá của sản phẩm WT000B-6T0VHTR-1  là bao nhiêu?'],
						['no' => '5', 'text' => 'Bạn vui lòng cho biết chính sách chiết khấu của PKH thực hiện như thế nào? '],
						['no' => '6', 'text' => 'Bạn vui lòng cho biết chính sách chiết khấu của PKH có bao nhiêu mức? Mỗi mức chiết khấu là bao nhiêu?'],
						['no' => '7', 'text' => 'Bạn vui lòng cho biết chính sách chiết khấu của PKH đang công bố ở các mức nào?'],
						['no' => '8', 'text' => 'Bạn vui lòng cho biết chính sách chiết khấu thưởng của PKH dành cho đại lý năm 2017?']
					]
				],
				[ 
					'no'   => 9,
					'name' => 'PURCHASING',
					'items' => [
						['no' => '1', 'text' => 'Bạn vui lòng cho biết 5 ký tự cuối của mã nhà máy Watertec có ý nghĩa gì?'],
						['no' => '2', 'text' => 'Bạn vui lòng cho biết các ký tự viết tắt WB, WP, WX, XL có ý nghĩa gì trong mã nhà máy Watertec? '],
						['no' => '3', 'text' => 'Bạn vui lòng cho biết diễn giải  Bib Tap L502B 3/4B Zemart có ý nghĩa gì?'],
						['no' => '4', 'text' => 'Bạn vui lòng cho biết thời gian cuối cùng đặt hàng nhà máy khi nào?'],
						['no' => '5', 'text' => 'Bạn vui lòng cho biết thời gian sản xuất của nhà máy mất bao lâu?']
					]
				],
				[ 
					'no'   => 10,
					'name' => 'ACCOUNTANT',
					'items' => [
						['no' => '1', 'text' => 'Bạn vui lòng cho biết việc thực hiện thanh toán cho nhà máy diễn ra ở thời điểm nào?'],
						['no' => '2', 'text' => 'Bạn vui lòng cho biết để thực hiện thanh toán cần phải chuẩn bị những thủ tục gì?'],
						['no' => '3', 'text' => 'Ban vui lòng cho biết khoản tiền được xem là quá hạn là bao lâu?'],
						['no' => '4', 'text' => 'Việc thực hiện nhắc nợ sẽ như thế nào và khi nào?'],
						['no' => '5', 'text' => 'Bạn vui lòng cho biết việc xác nhận khoản tiền chuyển khoản thực hiện theo cú pháp nào và khi nào?']
					]
				],
				[ 
					'no'   => 11,
					'name' => 'WAREHOUSE',
					'items' => [
						['no' => '1', 'text' => 'Bạn vui lòng cho biết việc sắp xếp nhập hàng gồm những gì? Khi nào?'],
						['no' => '2', 'text' => 'Bạn vui lòng cho biết thời gian thực hiện nhập hàng vào kho PKH khi nào?'],
						['no' => '3', 'text' => 'Ban vui lòng cho biết việc kiểm kho bao lâu một lần?']
					]
				],
				[ 
					'no'   => 12,
					'name' => 'MARKETING',
					'items' => [
						['no' => '1', 'text' => 'Bạn vui lòng cho biết sẽ có bao nhiêu lần cập nhật cho đại lý về thời gian nhận đặt hàng đến khi giao hàng?'],
						['no' => '2', 'text' => 'Bạn vui lòng cho biết các phương tiện cập nhật chính thức của PKH cho đại lý?'],
						['no' => '3', 'text' => 'Ban vui lòng cho biết năm 2017 sẽ diễn ra các hoạt động đăng báo theo định kỳ như thế nào?']
					]
				],
				[ 
					'no'   => 13,
					'name' => 'IT',
					'items' => [
						['no' => '1', 'text' => 'Bạn vui lòng cho biết việc qui trình làm báo giá thực hiện như thế nào?'],
						['no' => '2', 'text' => 'Bạn vui lòng cho biết daily report sẽ thể hiện các thông số gì?'],
						['no' => '3', 'text' => 'Ban vui lòng cho biết IT sẽ cung cấp gì cho bộ phận kinh doanh hàng ngày trước khi hệ thống đi vào hoạt động?'],
						['no' => '4', 'text' => 'Việc thực hiện nhắc nợ sẽ như thế nào và khi nào?'],
						['no' => '5', 'text' => 'Bạn vui lòng cho biết việc xác nhận khoản tiền chuyển khoản thực hiện theo cú pháp nào và khi nào?']
					]
				]
			];

		if( $names != null ) {
			$result = [];

			foreach ($names as $name) {
				foreach ($sentences as $group) {
					if( $group['no'] == $name) {
						$result[] = $group;
					}
				}
			}

			return $result;
		}

		return $sentences;
    }

}
