<!-- Security Status Widget Component -->
<div class="bg-gray-800 rounded-lg p-3 mb-4 border border-gray-700">
  <div class="flex items-center justify-between mb-2">
    <h4 class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Security Status</h4>
    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
  </div>
  <div class="grid grid-cols-2 gap-2 text-xs">
    <div class="bg-red-900 bg-opacity-50 px-2 py-1 rounded text-red-300 text-center">
      <div class="font-bold"><?= $security_stats['critical'] ?? 3 ?></div>
      <div>Critical</div>
    </div>
    <div class="bg-orange-900 bg-opacity-50 px-2 py-1 rounded text-orange-300 text-center">
      <div class="font-bold"><?= $security_stats['alerts'] ?? 7 ?></div>
      <div>Alerts</div>
    </div>
    <div class="bg-yellow-900 bg-opacity-50 px-2 py-1 rounded text-yellow-300 text-center">
      <div class="font-bold"><?= $security_stats['threats'] ?? 12 ?></div>
      <div>Threats</div>
    </div>
    <div class="bg-purple-900 bg-opacity-50 px-2 py-1 rounded text-purple-300 text-center">
      <div class="font-bold"><?= $security_stats['cases'] ?? 2 ?></div>
      <div>Cases</div>
    </div>
  </div>
</div>