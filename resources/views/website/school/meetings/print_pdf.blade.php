{{-- Rest of your existing Blade content --}}

<!-- Print-specific content for RTL languages like Arabic -->
<div class="print-section" style=" direction: rtl; text-align: right;">
    <h1> {{ $Committees_and_teams['title'] }}</h1>

    <!-- تفاصيل الاجتماع -->
    <h2>تفاصيل الاجتماع</h2>
    <p><strong>النوع:</strong> {{ $item_val['type'] == 1 ? 'طارئ' : 'دوري' }}</p>
    <p><strong>التاريخ:</strong> {{ $item_val['start_date'] ?? 'غير محدد' }}</p>
    <p><strong>العنوان:</strong> {{ $item_val['title'] ?? 'غير محدد' }}</p>
    <p><strong>الوقت:</strong> {{ $item_val['start_time'] ?? 'غير محدد' }}</p>
    <p><strong>المكان:</strong> {{ $item_val['location'] ?? 'غير محدد' }}</p>
    <p><strong>الفصل الدراسي:</strong> {{ $item_val['Semester'] ?? 'غير محدد' }}</p>

    <!-- جدول أعمال الاجتماع -->
    <h2>جدول أعمال الاجتماع</h2>
    @if(isset($item_val['meeting_agenda']) && is_array($item_val['meeting_agenda']))
        @foreach($item_val['meeting_agenda'] as $agenda)
            <p>{{ $loop->iteration }}. {{ $agenda['Item'] }}</p>
        @endforeach
    @endif

    <!-- توصيات الاجتماع -->
    <h2>توصيات الاجتماع</h2>
    @if(isset($item_val['meeting_recommendations']) && is_array($item_val['meeting_recommendations']))
        @foreach($item_val['meeting_recommendations'] as $recommendation)
            <p>{{ $loop->iteration }}. {{ $recommendation['Item'] }}</p>
        @endforeach
    @endif

    <!-- أقسام إضافية حسب الحاجة -->
</div>

{{-- Existing scripts and styles --}}
