import { Module } from "@nestjs/common";
import { CommandRequestModuleBase } from "./base/commandRequest.module.base";
import { CommandRequestService } from "./commandRequest.service";
import { CommandRequestController } from "./commandRequest.controller";
import { CommandRequestResolver } from "./commandRequest.resolver";

@Module({
  imports: [CommandRequestModuleBase],
  controllers: [CommandRequestController],
  providers: [CommandRequestService, CommandRequestResolver],
  exports: [CommandRequestService],
})
export class CommandRequestModule {}
